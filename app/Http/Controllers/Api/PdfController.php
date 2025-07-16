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
            
            // Create directory if it doesn't exist
            $directory = 'pdfs/vehicles';
            Storage::makeDirectory($directory);
            
            // Generate filename
            $filename = "vehicle-{$id}-" . date('YmdHis') . ".pdf";
            $storagePath = storage_path("app/{$directory}/{$filename}");
            
            // Prepare data for PDF including header and footer
            $data = [
                'vehicle' => $vehicleData['vehicle'] ?? $vehicleData,
                'id' => $id
            ];
            
            // Generate PDF with the new template, header and footer
            $pdf = PdfHelper::fromView('pdfs.vehicle-template', $data)
                ->headerView('pdfs.partials.header', $data)
                ->footerView('pdfs.partials.footer', $data);
            
            // Save to storage
            $pdf->save($storagePath);
            Log::info("PDF saved to: {$storagePath}");
            
            // Return response with download and basic vehicle data
            return response()->json([
                'success' => true,
                'message' => 'PDF generated successfully',
                'file_path' => $storagePath,
                'download_url' => route('api.pdf.download', ['filename' => $filename]),
                'vehicle' => [
                    'id' => $vehicleData['vehicle']['id'] ?? null,
                    'make' => $vehicleData['vehicle']['make'] ?? null,
                    'model' => $vehicleData['vehicle']['model'] ?? null,
                    'year' => $vehicleData['vehicle']['year'] ?? null,
                    'color' => $vehicleData['vehicle']['color'] ?? null,
                    'registrationPlate' => $vehicleData['vehicle']['registrationPlate'] ?? null,
                ],
            ]);
        } catch (\Exception $e) {
            Log::error('PDF generation failed: ' . $e->getMessage());
            
            return response()->json([
                'error' => 'PDF generation failed',
                'message' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ], 500);
        }
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
}
