<?php

namespace Tests\Feature\Api;

use Tests\TestCase;
use Spatie\LaravelPdf\Facades\Pdf;
use Illuminate\Support\Facades\Log;

class PdfGenerationTest extends TestCase
{


    /**
     * Test actual PDF generation with Browsershot.
     */
    public function test_actual_pdf_generation_with_browsershot(): void
    {
        // Don't use Pdf::fake() here to allow real PDF generation
        
        $html = '<h1>Test PDF</h1><p>Generated with Browsershot</p>';
        $outputPath = storage_path('app/test-output.pdf');
        
        // Use the real PDF generation
        $pdf = \Spatie\LaravelPdf\Facades\Pdf::html($html)
            ->withBrowsershot(function ($browsershot) {
                $browsershot->noSandbox(); // Required for Docker environments
            })
            ->save($outputPath);
        
        // Assert the file was created
        $this->assertFileExists($outputPath);
        
        // Clean up
        if (file_exists($outputPath)) {
            unlink($outputPath);
        }
    }
}
