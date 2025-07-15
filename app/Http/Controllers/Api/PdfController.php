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
        try {
            // Log environment variables for debugging
            Log::info('NODE_PATH: ' . getenv('NODE_PATH'));
            Log::info('PUPPETEER_EXECUTABLE_PATH: ' . getenv('PUPPETEER_EXECUTABLE_PATH'));
            
            // Get vehicle data from API
            $vehicleData = $this->vehicleService->getVehicleById($id);
            
            // If API call fails, try local JSON file as fallback
            if (!$vehicleData) {
                Log::warning("API request failed, using local JSON data");
                $vehicleData = $this->vehicleService->getVehicleFromLocalJson();
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
            
            // Generate PDF using the vehicle data and our template
            $pdf = PdfHelper::fromView('pdfs.vehicle', [
                'vehicle' => $vehicleData['vehicle'] ?? $vehicleData,
                'id' => $id
            ]);
            
            // Save to storage
            $pdf->save($storagePath);
            Log::info("PDF saved to: {$storagePath}");
            
            // Return response with download
            return response()->json([
                'success' => true,
                'message' => 'PDF generated successfully',
                'file_path' => $storagePath,
                'download_url' => route('api.pdf.download', ['filename' => $filename]),
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
