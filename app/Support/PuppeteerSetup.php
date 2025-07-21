<?php

namespace App\Support;

use Illuminate\Support\Facades\Log;
use Symfony\Component\Process\Process;

class PuppeteerSetup
{
    /**
     * Register Chrome with Puppeteer
     *
     * @return bool
     */
    public static function registerChrome(): bool
    {
        try {
            $chromePath = PdfHelper::getChromePath();
            Log::info("Registering Chrome at: {$chromePath}");
            
            // Create the puppeteer config directory if it doesn't exist
            $homeDir = getenv('HOME') ?: '/root';
            $puppeteerDir = "{$homeDir}/.cache/puppeteer";
            
            if (!is_dir($puppeteerDir)) {
                mkdir($puppeteerDir, 0777, true);
                Log::info("Created puppeteer directory: {$puppeteerDir}");
            }
            
            // Create browsers.json to register Chrome with Puppeteer
            $browsersConfig = [
                'browsers' => [
                    [
                        'name' => 'chrome',
                        'revision' => '121.0.6167.85',
                        'installPath' => dirname($chromePath),
                        'executablePath' => $chromePath
                    ]
                ]
            ];
            
            $configPath = "{$puppeteerDir}/browsers.json";
            file_put_contents($configPath, json_encode($browsersConfig, JSON_PRETTY_PRINT));
            Log::info("Created Puppeteer browsers.json at: {$configPath}");
            
            return true;
        } catch (\Exception $e) {
            Log::error("Failed to register Chrome: " . $e->getMessage());
            return false;
        }
    }
    
    /**
     * Install Puppeteer browsers using npm
     *
     * @return bool
     */
    public static function installPuppeteerBrowsers(): bool
    {
        try {
            $process = new Process(['npm', 'exec', '--', 'puppeteer', 'browsers', 'install', 'chrome']);
            $process->setTimeout(300);
            $process->run();
            
            if ($process->isSuccessful()) {
                Log::info("Successfully installed Puppeteer browser: " . $process->getOutput());
                return true;
            } else {
                Log::error("Failed to install Puppeteer browser: " . $process->getErrorOutput());
                return false;
            }
        } catch (\Exception $e) {
            Log::error("Error installing Puppeteer browser: " . $e->getMessage());
            return false;
        }
    }
}
