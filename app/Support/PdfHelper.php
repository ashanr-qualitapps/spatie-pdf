<?php

namespace App\Support;

use Spatie\LaravelPdf\Facades\Pdf;
use Spatie\LaravelPdf\PdfBuilder;
use Illuminate\Support\Facades\Log;

class PdfHelper
{
    /**
     * Get the Chrome executable path
     *
     * @return string
     */
    protected static function getChromePath(): string
    {
        // Try multiple possible paths in order of preference
        $possiblePaths = [
            '/usr/bin/chromium',
            '/usr/bin/chromium-browser',
            '/usr/bin/chrome',
            '/usr/bin/google-chrome',
            '/usr/local/bin/chromium',
            '/usr/local/bin/chrome',
            '/usr/local/bin/google-chrome'
        ];

        // First try environment variables
        $envPath = env('PUPPETEER_EXECUTABLE_PATH') ?? env('CHROME_PATH');
        
        if ($envPath && file_exists($envPath)) {
            Log::info('Using Chrome path from environment: ' . $envPath);
            return $envPath;
        }

        // Then try to find the executable
        foreach ($possiblePaths as $path) {
            if (file_exists($path)) {
                Log::info('Found Chrome executable at: ' . $path);
                return $path;
            }
        }

        // Default fallback
        Log::warning('Could not find Chrome executable, using default path');
        return '/usr/bin/chromium';
    }

    /**
     * Generate a PDF from HTML content with sandbox disabled for Docker environments
     *
     * @param string $html The HTML content
     * @param string|null $filename Optional filename for the PDF
     * @return PdfBuilder
     */
    public static function fromHtml(string $html, ?string $filename = null): PdfBuilder
    {
        $pdf = Pdf::html($html);

        // Use a default filename if none provided
        $filename = $filename ?? 'document.pdf';
        
        $chromePath = self::getChromePath();
        
        Log::info('PDF generation using Chrome at: ' . $chromePath);

        return $pdf->withBrowsershot(function ($browsershot) use ($chromePath) {
            $browsershot->noSandbox()
                ->setNodeBinary(env('NODE_BINARY_PATH', '/usr/bin/node'))
                ->setChromePath($chromePath)
                ->addChromiumArguments([
                    'no-sandbox',
                    'disable-setuid-sandbox',
                    'disable-dev-shm-usage'
                ])
                ->setDebuggingPort(9222);
        })->format(config('pdf.default_paper_size'))
          ->name($filename);
    }

    /**
     * Generate a PDF from a view with sandbox disabled for Docker environments
     *
     * @param string $view The view name
     * @param array $data The data to pass to the view
     * @param string|null $filename Optional filename for the PDF
     * @return PdfBuilder
     */
    public static function fromView(string $view, array $data = [], ?string $filename = null): PdfBuilder
    {
        $pdf = Pdf::view($view, $data);

        // Use a default filename if none provided
        $filename = $filename ?? 'document.pdf';
        
        $chromePath = self::getChromePath();
        
        Log::info('PDF generation using Chrome at: ' . $chromePath);

        return $pdf->withBrowsershot(function ($browsershot) use ($chromePath) {
            $browsershot->noSandbox()
                ->setNodeBinary(env('NODE_BINARY_PATH', '/usr/bin/node'))
                ->setChromePath($chromePath)
                ->addChromiumArguments([
                    'no-sandbox',
                    'disable-setuid-sandbox',
                    'disable-dev-shm-usage'
                ]);
        })->format(config('pdf.default_paper_size'))
          ->name($filename);
    }
}
