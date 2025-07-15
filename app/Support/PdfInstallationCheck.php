<?php

namespace App\Support;

use Illuminate\Support\Facades\Log;
use Symfony\Component\Process\Process;

class PdfInstallationCheck
{
    public static function diagnose(): array
    {
        $results = [];
        
        // Check if chromium exists
        $chromiumPath = env('PUPPETEER_EXECUTABLE_PATH', '/usr/bin/chromium');
        $results['chromium_exists'] = file_exists($chromiumPath);
        $results['chromium_path'] = $chromiumPath;
        
        // Check if node exists
        $nodePath = env('NODE_BINARY_PATH', '/usr/bin/node');
        $results['node_exists'] = file_exists($nodePath);
        $results['node_path'] = $nodePath;
        
        // Check NODE_PATH environment variable
        $results['node_modules_path'] = getenv('NODE_PATH');
        
        // Check if puppeteer is installed globally
        $process = Process::fromShellCommandline('npm list -g puppeteer');
        $process->run();
        $results['puppeteer_global'] = $process->isSuccessful() ? trim($process->getOutput()) : 'Not installed globally';
        
        // Check if puppeteer is installed locally
        $process = Process::fromShellCommandline('npm list puppeteer');
        $process->run();
        $results['puppeteer_local'] = $process->isSuccessful() ? trim($process->getOutput()) : 'Not installed locally';
        
        // Log all results
        Log::info('PDF Installation Check', $results);
        
        return $results;
    }
}
