<?php

namespace App\Support;

use Spatie\LaravelPdf\Facades\Pdf;
use Illuminate\Support\Facades\Log;
use Spatie\LaravelPdf\PdfBuilder;

class PdfHelper
{
    /**
     * Create a PDF from HTML content
     */
    public static function fromHtml($html, $outputPath = null)
    {
        // Ensure Chrome is registered with Puppeteer
        PuppeteerSetup::registerChrome();
        
        $pdf = Pdf::html($html)
            ->withBrowsershot(function ($browsershot) {
                $chromePath = self::getChromePath();
                Log::info("Using Chrome path: {$chromePath}");
                
                $browsershot->noSandbox()
                    ->setNodeBinary(getenv('NODE_BINARY_PATH') ?: '/usr/bin/node')
                    ->setChromePath($chromePath)
                    ->setNodeModulePath(self::getNodeModulesPath())
                    ->showBackground(true)
                    ->addChromiumArguments([
                        '--disable-gpu',
                        '--disable-dev-shm-usage',
                        '--disable-setuid-sandbox',
                        '--no-first-run',
                        '--no-zygote',
                        '--single-process',
                        '--disable-background-timer-throttling',
                        '--disable-backgrounding-occluded-windows',
                        '--disable-renderer-backgrounding'
                    ])
                    ->timeout(60);
            });
        
        if ($outputPath) {
            $pdf->name($outputPath);
        }
        
        return $pdf;
    }
    
    /**
     * Create a PDF from a view
     */
    public static function fromView($view, array $data = [], $outputPath = null)
    {
        // Ensure Chrome is registered with Puppeteer
        PuppeteerSetup::registerChrome();
        
        $pdf = Pdf::view($view, $data)
            ->withBrowsershot(function ($browsershot) {
                $chromePath = self::getChromePath();
                Log::info("Using Chrome path: {$chromePath}");
                
                $browsershot->noSandbox()
                    ->setNodeBinary(getenv('NODE_BINARY_PATH') ?: '/usr/bin/node')
                    ->setChromePath($chromePath)
                    ->setNodeModulePath(self::getNodeModulesPath())
                    ->showBackground(true)
                    ->addChromiumArguments([
                        '--disable-gpu',
                        '--disable-dev-shm-usage',
                        '--disable-setuid-sandbox',
                        '--no-first-run',
                        '--no-zygote',
                        '--single-process',
                        '--disable-background-timer-throttling',
                        '--disable-backgrounding-occluded-windows',
                        '--disable-renderer-backgrounding'
                    ])
                    ->timeout(60);
            });
        
        if ($outputPath) {
            $pdf->name($outputPath);
        }
        
        return $pdf;
    }
    
    /**
     * Get the Chrome executable path
     */
    public static function getChromePath()
    {
        $chromePath = getenv('PUPPETEER_EXECUTABLE_PATH');
        
        if (!$chromePath || !file_exists($chromePath)) {
            $possiblePaths = [
                '/usr/bin/google-chrome',
                '/usr/bin/google-chrome-stable',
                '/usr/bin/chromium',
                '/usr/bin/chromium-browser',
                '/usr/bin/chrome',
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
                $chromePath = '/usr/bin/google-chrome';
            }
            
            Log::info("Using detected Chrome path: {$chromePath}");
        }
        
        return $chromePath;
    }
    
    /**
     * Get the Node modules path
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
        
        return '/usr/local/lib/node_modules'; // Default fallback
    }
}
