<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Support\PdfHelper;
use App\Support\PuppeteerSetup;
use App\Services\VehicleService;
use Spatie\LaravelPdf\Facades\Pdf;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class PdfController extends Controller
{
    protected $vehicleService;

    public function __construct(VehicleService $vehicleService)
    {
        $this->vehicleService = $vehicleService;

        // Register Chrome with Puppeteer on controller initialization
        PuppeteerSetup::registerChrome();
    }

    /**
     * Generate a PDF based on the provided ID.
     *
     * @param string $id
     * @return \Illuminate\Http\Response
     */
    public function generatePdf($id)
    {
        // Validate that $id is a positive integer
        if (!ctype_digit((string)$id) || (int)$id <= 0) {
            return response()->json([
                'error' => 'Invalid vehicle ID'
            ], 422);
        }

        try {
            // Log environment variables for debugging
            Log::info('NODE_PATH: ' . getenv('NODE_PATH'));
            Log::info('PUPPETEER_EXECUTABLE_PATH: ' . getenv('PUPPETEER_EXECUTABLE_PATH'));

            // Get vehicle data from API
            $vehicleData = $this->vehicleService->getVehicleById($id);

            // If API call fails, try fetching again from the API endpoint
            if (!$vehicleData) {
                Log::warning("API request failed, retrying API call for vehicle ID: {$id}");
                $vehicleData = $this->vehicleService->getVehicleById($id);
            }

            if (!$vehicleData) {
                return response()->json([
                    'error' => 'Vehicle data not found',
                ], 404);
            }

            // Extract vehicle data and apply field mapping
            $vehicle = $vehicleData['vehicle'] ?? $vehicleData;
            $mappedVehicle = $this->mapVehicleFields($vehicle);

            // Create directory if it doesn't exist
            $directory = 'pdfs/vehicles';
            Storage::makeDirectory($directory);

            // Generate filename
            $filename = "quadis-" . ($mappedVehicle['make_slug'] ?? 'vehicle') . "-" . ($mappedVehicle['model_slug'] ?? 'model') . "-{$id}-" . date('YmdHis') . ".pdf";
            $storagePath = storage_path("app/{$directory}/{$filename}");

            // Prepare data for PDF including header and footer
            $data = [
                'vehicle' => $mappedVehicle,
                'id' => $id,
                'generated_at' => now()->format('Y-m-d H:i:s'),
                'reference' => $mappedVehicle['vsbWip'] ?? "REF-{$id}",
                'header_logo' => asset('storage/logo-quadis.es-blanco.png'), // Pass logo path to header
            ];

            // Generate PDF with the QUADIS.es template, header and footer
            $pdf = PdfHelper::fromView('pdfs.quadis-vehicle-template', $data)
                ->headerView('pdfs.partials.header', $data)
                ->footerView('pdfs.partials.footer', $data)
                ->format('A4')
                ->margins(10, 10, 10, 10);

            // Save to storage
            $pdf->save($storagePath);
            Log::info("PDF saved to: {$storagePath}");

            // Return response with download and basic vehicle data
            return response()->json([
                'success' => true,
                'message' => 'PDF generated successfully',
                'file_path' => $storagePath,
                'filename' => $filename,
                'download_url' => route('api.pdf.download', ['filename' => $filename]),
                'vehicle' => [
                    'id' => $mappedVehicle['id'] ?? null,
                    'make' => $mappedVehicle['make'] ?? null,
                    'model' => $mappedVehicle['model'] ?? null,
                    'year' => $mappedVehicle['year'] ?? null,
                    'color' => $mappedVehicle['color'] ?? null,
                    'reference' => $mappedVehicle['vsbWip'] ?? null,
                    'price' => $mappedVehicle['price'] ?? null,
                    'financed_price' => $mappedVehicle['financedPrice'] ?? null,
                ],
            ]);
        } catch (\Exception $e) {
            Log::error('PDF generation failed: ' . $e->getMessage());

            return response()->json([
                'error' => 'PDF generation failed',
                'message' => $e->getMessage(),
                'trace' => config('app.debug') ? $e->getTraceAsString() : null
            ], 500);
        }
    }

    /**
     * Map vehicle fields according to QUADIS.es template requirements
     *
     * @param array $vehicle
     * @return array
     */
    private function mapVehicleFields($vehicle)
    {
        // Helper function to safely access nested array values
        $getValue = function ($path, $default = null) use ($vehicle) {
            $keys = explode('.', $path);
            $value = $vehicle;

            foreach ($keys as $key) {
                if (is_array($value) && array_key_exists($key, $value)) {
                    $value = $value[$key];
                } else {
                    return $default;
                }
            }

            return $value;
        };

        // Map fields according to QUADIS.es template
        $mapped = [
            // Basic vehicle info
            'id' => $getValue('id'),
            'make' => $getValue('make'),
            'model' => $getValue('model'),
            'fullname' => $getValue('fullname', $getValue('make') . ' ' . $getValue('model')),
            'version' => $getValue('version'),
            'year' => $getValue('year'),
            'color' => $getValue('color'),
            'fuel' => $getValue('fuel'),
            'transmission' => $getValue('transmission'),
            'driveTrain' => $getValue('driveTrain'),

            // Reference and identifiers
            'vsbWip' => $getValue('vsbWip'),
            'registrationPlate' => $getValue('registrationPlate'),
            'chassisNumber' => $getValue('chassisNumber'),

            // Pricing
            'price' => $getValue('price'),
            'financedPrice' => $getValue('financedPrice'),
            'previousPrice' => $getValue('previousPrice'),
            'saving' => $getValue('saving'),
            'discount' => $getValue('discount'),

            // Financial information
            'financialInformation' => $getValue('financialInformation', []),

            // Physical characteristics
            'kilometers' => $getValue('kilometers'),
            'doors' => $getValue('doors'),
            'seats' => $getValue('seats'),
            'height' => $getValue('height'),
            'length' => $getValue('length'),
            'width' => $getValue('width'),
            'weight' => $getValue('weight'),

            // Performance
            'power' => $getValue('power'),
            'powerCV' => $getValue('powerCV'),
            'engineCapacity' => $getValue('engineCapacity'),
            'maximumSpeed' => $getValue('maximumSpeed'),
            'consumption' => $getValue('consumption'),
            'emissions' => $getValue('emissions'),

            // Categories and types
            'type' => $getValue('type', []),
            'category' => $getValue('category', []),
            'environmentalLabel' => $getValue('environmentalLabel'),
            'warranty' => $getValue('warranty'),

            // Images
            'imageUrl' => $getValue('imageUrl'),
            'images' => $getValue('images', []),

            // Descriptions
            'description' => $getValue('description'),
            'description2' => $getValue('description2'),
            'extraDescription' => $getValue('extraDescription'),

            // Equipment
            'equipment' => $getValue('equipment', []),

            // Additional fields
            'availability' => $getValue('availability'),
            'dealerName' => $getValue('dealerName'),
            'email' => $getValue('email'),

            // Create slugs for filename generation
            'make_slug' => $this->createSlug($getValue('make', '')),
            'model_slug' => $this->createSlug($getValue('model', '')),
        ];

        return $mapped;
    }

    /**
     * Create a URL-friendly slug from a string
     *
     * @param string $text
     * @return string
     */
    private function createSlug($text)
    {
        // Replace non-alphanumeric characters with hyphens
        $text = preg_replace('/[^\pL\d]+/u', '-', $text);

        // Remove unwanted characters
        $text = preg_replace('/[^-\w]+/', '', $text);

        // Trim and lowercase
        $text = trim($text, '-');
        $text = strtolower($text);

        return $text;
    }

    /**
     * Download a previously generated PDF.
     *
     * @param string $filename
     * @return \Illuminate\Http\Response
     */
    public function downloadPdf($filename)
    {
        $path = "pdfs/vehicles/{$filename}";

        if (!Storage::exists($path)) {
            return response()->json([
                'error' => 'PDF file not found'
            ], 404);
        }

        return Storage::download($path, $filename);
    }

    /**
     * Get vehicle data preview for testing
     *
     * @param string $id
     * @return \Illuminate\Http\Response
     */
    public function getVehiclePreview($id)
    {
        try {
            $vehicleData = $this->vehicleService->getVehicleById($id);

            if (!$vehicleData) {
                return response()->json([
                    'error' => 'Vehicle data not found',
                ], 404);
            }

            $vehicle = $vehicleData['vehicle'] ?? $vehicleData;
            $mappedVehicle = $this->mapVehicleFields($vehicle);

            return response()->json([
                'success' => true,
                'raw_data' => $vehicle,
                'mapped_data' => $mappedVehicle
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'error' => 'Failed to retrieve vehicle data',
                'message' => $e->getMessage()
            ], 500);
        }
    }
}