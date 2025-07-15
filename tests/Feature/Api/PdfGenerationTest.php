<?php

namespace Tests\Feature\Api;

use Tests\TestCase;
use Spatie\LaravelPdf\Facades\Pdf;
use Illuminate\Support\Facades\Log;
use App\Support\PdfHelper;

class PdfGenerationTest extends TestCase
{
    /**
     * Test that we can detect and use Chrome executable.
     */
    public function test_chrome_executable_detection(): void
    {
        // Log environment variables
        Log::info('NODE_PATH: ' . getenv('NODE_PATH'));
        Log::info('PUPPETEER_EXECUTABLE_PATH: ' . getenv('PUPPETEER_EXECUTABLE_PATH'));
        
        // Call the getChromePath method using reflection
        $class = new \ReflectionClass(PdfHelper::class);
        $method = $class->getMethod('getChromePath');
        $method->setAccessible(true);
        $chromePath = $method->invoke(null);
        
        // Assert the path exists
        $this->assertFileExists($chromePath);
        Log::info('Chrome path detected: ' . $chromePath);
    }

    /**
     * Test actual PDF generation with Browsershot.
     */
    public function test_actual_pdf_generation_with_browsershot(): void
    {
        // Don't use Pdf::fake() here to allow real PDF generation
        
        $html = '<h1>Test PDF</h1><p>Generated with Browsershot</p>';
        $outputPath = storage_path('app/test-output.pdf');
        
        // Use the PdfHelper instead of direct Pdf facade
        $pdf = PdfHelper::fromHtml($html)
            ->save($outputPath);
        
        // Assert the file was created
        $this->assertFileExists($outputPath);
        
        // Clean up
        if (file_exists($outputPath)) {
            unlink($outputPath);
        }
    }
}
