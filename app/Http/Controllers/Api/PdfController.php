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
use App\Helpers\PdfAsset;

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

    /**
     * Generate a new PDF and redirect to download it.
     *
     * @param string $id
     * @return \Illuminate\Http\Response
     */
    public function getPdfUrl($id)
    {
        // Validate that $id is a positive integer
        if (!ctype_digit((string)$id) || (int)$id <= 0) {
            return response()->json([
                'error' => 'Invalid vehicle ID'
            ], 422);
        }

        try {
            // Get vehicle data from API
            $vehicleData = $this->vehicleService->getVehicleById($id);

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

            $header_logo_path = public_path('logo.png');
            $footer_logo_path = $header_logo_path; // Reuse if same logo

            $characteristicIcons = [
                // Básicos
                'matriculation' => PdfAsset::base64('icons/icon-matricula.png'),
                'kilometers'    => PdfAsset::base64('icons/icon-kms.png'),

                // Motorización y distintivos
                'fuel'          => PdfAsset::base64('icons/icon-combustible.png'),
                'env_label'     => PdfAsset::base64('icons/icon-fondo.png'),

                // Mecánicos
                'gearbox'       => PdfAsset::base64('icons/icon-transmision.png'),
                'drive_train'   => PdfAsset::base64('icons/icon-traccion.png'),
                'power'         => PdfAsset::base64('icons/icon-potencia.png'),

                // Carrocería
                'doors'         => PdfAsset::base64('icons/icon-puertas.png'),
                'seats'         => PdfAsset::base64('icons/icon-asientos.png'),
                'color'         => PdfAsset::base64('icons/icon-pintura.png'),
                'body'          => PdfAsset::base64('icons/icon-coches-compacto.png'),

                // Garantía y tipo
                'warranty'      => PdfAsset::base64('icons/icon-garantia.png'),
                'vehicle_type'  => PdfAsset::base64('icons/icon-tipo.png'),
            ];

          // Base64 encode for embedding
            $header_logo_base64 = 'data:image/png;base64,' . base64_encode(file_get_contents($header_logo_path));
            $footer_logo_base64 = $header_logo_base64;
            $data = [
                'vehicle' => $mappedVehicle,
                'id' => $id,
                'generated_at' => now()->format('Y-m-d H:i:s'),
                'reference' => $mappedVehicle['vsbWip'] ?? "REF-{$id}",
                'header_logo' => $header_logo_base64,
                'footer_logo' => $footer_logo_base64,
                'cache_bust' => time(),
                'icons'=> $characteristicIcons,
            ];

            // Generate PDF
            $pdf = PdfHelper::fromView('pdfs.quadis-vehicle-template', $data)
                ->format('A4')
                ->margins(0, 0, 10, 0);
            
            $pdf->withBrowsershot(function($browsershot) {
                $browsershot->noSandbox()
              ->waitUntilNetworkIdle()
              ->waitForFunction('document.fonts.ready')
              ->emulateMedia('print');            });

            // Save to storage
            $pdf->save($storagePath);
            Log::info("PDF generated and saved to: {$storagePath}");

            // Redirect to download the newly generated PDF
            return redirect(route('api.pdf.download', ['filename' => $filename]));
            
        } catch (\Exception $e) {
            Log::error('PDF generation failed: ' . $e->getMessage());
            return response()->json([
                'error' => 'PDF generation failed',
                'message' => $e->getMessage()
            ], 500);
        }
    }
}