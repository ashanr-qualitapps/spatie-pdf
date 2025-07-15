<?php

namespace App\Support;

use Spatie\LaravelPdf\Facades\Pdf;
use Illuminate\Support\Facades\Log;

class PdfHelper
{
    /**
     * Create a PDF from HTML content
     *
     * @param string $html The HTML content
     * @param string|null $outputPath Optional output path to save
     * @return \Spatie\LaravelPdf\PdfBuilder
     */
    public static function fromHtml($html, $outputPath = null)
    {
        // Ensure Chrome is registered with Puppeteer
        PuppeteerSetup::registerChrome();
        
        $pdf = Pdf::html($html)
            ->withBrowsershot(function ($browsershot) {
                $chromePath = self::getChromePath();
                $browsershot->noSandbox()
                    ->setNodeBinary(getenv('NODE_BINARY_PATH') ?: '/usr/bin/node')
                    ->setChromePath($chromePath)
                    ->setNodeModulePath(self::getNodeModulesPath())
                    ->showBackground(true)
                    ->timeout(60);
            });
            
        if ($outputPath) {
            $pdf->name($outputPath);
        }
            
        return $pdf;
    }
    
    /**
     * Create a PDF from a view
     *
     * @param string $view The view name
     * @param array $data The data to pass to the view
     * @param string|null $outputPath Optional output path to save
     * @return \Spatie\LaravelPdf\PdfBuilder
     */
    public static function fromView($view, array $data = [], $outputPath = null)
    {
        // Ensure Chrome is registered with Puppeteer
        PuppeteerSetup::registerChrome();
        
        $pdf = Pdf::view($view, $data)
            ->withBrowsershot(function ($browsershot) {
                $chromePath = self::getChromePath();
                $browsershot->noSandbox()
                    ->setNodeBinary(getenv('NODE_BINARY_PATH') ?: '/usr/bin/node')
                    ->setChromePath($chromePath)
                    ->setNodeModulePath(self::getNodeModulesPath())
                    ->showBackground(true)
                    ->timeout(60);
            });
            
        if ($outputPath) {
            $pdf->name($outputPath);
        }
            
        return $pdf;
    }
    
    /**
     * Get the Chrome executable path
     *
     * @return string
     */
    public static function getChromePath()
    {
        $chromePath = getenv('PUPPETEER_EXECUTABLE_PATH');
        
        if (!$chromePath || !file_exists($chromePath)) {
            $possiblePaths = [
                '/usr/bin/chromium',
                '/usr/bin/chromium-browser',
                '/usr/bin/chrome',
                '/usr/bin/google-chrome',
                '/usr/local/bin/chromium',
                '/usr/local/bin/chrome',
                '/usr/local/bin/google-chrome'
            ];
            
            foreach ($possiblePaths as $path) {
                if (file_exists($path)) {
                    $chromePath = $path;
                    break;
                }
            }
            
            if (!$chromePath) {
                $chromePath = '/usr/bin/chromium';
            }
            
            Log::info("Using detected Chrome path: {$chromePath}");
        }
        
        return $chromePath;
    }
    
    /**
     * Get the Node modules path
     *
     * @return string
     */
    public static function getNodeModulesPath()
    {
        $nodePath = getenv('NODE_PATH');
        if (!empty($nodePath)) {
            $paths = explode(':', $nodePath);
            foreach ($paths as $path) {
                if (is_dir($path)) {
                    return $path;
                }
            }
        }
        
        // Try common paths
        $possiblePaths = [
            '/usr/local/lib/node_modules',
            '/node_modules',
            '/var/www/html/node_modules'
        ];
        
        foreach ($possiblePaths as $path) {
            if (is_dir($path)) {
                return $path;
            }
        }
        
        return '/node_modules'; // Default fallback
    }
}
