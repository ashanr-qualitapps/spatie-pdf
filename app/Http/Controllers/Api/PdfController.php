<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Support\PdfHelper;
use Spatie\LaravelPdf\Facades\Pdf;
use Illuminate\Support\Facades\Log;

class PdfController extends Controller
{
    /**
     * Generate a PDF based on the provided ID.
     *
     * @param string $id
     * @return \Illuminate\Http\Response
     */
    public function generatePdf($id)
    {
        try {
            // Create a simple PDF with the ID included
            $html = "<h1>Generated PDF</h1><p>ID: {$id}</p>";
            
            // Log the environment variables for debugging
            Log::info('NODE_PATH: ' . getenv('NODE_PATH'));
            Log::info('PUPPETEER_EXECUTABLE_PATH: ' . getenv('PUPPETEER_EXECUTABLE_PATH'));
            
            // Use the enhanced PdfHelper which properly configures Chrome
            return PdfHelper::fromHtml($html, "document-{$id}.pdf")
                ->download();
        } catch (\Exception $e) {
            Log::error('PDF generation failed: ' . $e->getMessage());
            
            return response()->json([
                'error' => 'PDF generation failed',
                'message' => $e->getMessage()
            ], 500);
        }
    }
}
