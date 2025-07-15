<?php

/*
|--------------------------------------------------------------------------
| Test Bootstrap
|--------------------------------------------------------------------------
|
| This file is loaded before any tests are run to ensure environment
| variables are properly set.
|
*/

// Set NODE_PATH for tests if not already set
if (empty(getenv('NODE_PATH'))) {
    putenv('NODE_PATH=/usr/local/lib/node_modules:/node_modules');
}

// Set PUPPETEER_EXECUTABLE_PATH if not already set
if (empty(getenv('PUPPETEER_EXECUTABLE_PATH'))) {
    // Try to find the Chrome executable
    $possiblePaths = [
        '/usr/bin/chromium',
        '/usr/bin/chromium-browser',
        '/usr/bin/chrome',
        '/usr/bin/google-chrome',
        '/usr/local/bin/chromium',
        '/usr/local/bin/chrome',
        '/usr/local/bin/google-chrome'
    ];
    
    $chromePath = '/usr/bin/chromium'; // Default
    
    foreach ($possiblePaths as $path) {
        if (file_exists($path)) {
            $chromePath = $path;
            break;
        }
    }
    
    putenv("PUPPETEER_EXECUTABLE_PATH={$chromePath}");
    echo "Set PUPPETEER_EXECUTABLE_PATH to {$chromePath}\n";
}

// Create directory for Puppeteer cache if it doesn't exist
$homeDir = getenv('HOME') ?: '/root';
$puppeteerDir = $homeDir . '/.cache/puppeteer';
if (!is_dir($puppeteerDir)) {
    mkdir($puppeteerDir, 0777, true);
    echo "Created puppeteer cache directory: {$puppeteerDir}\n";
}

// Register Chrome with Puppeteer by creating browsers.json
$chromePath = getenv('PUPPETEER_EXECUTABLE_PATH');
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
echo "Created Puppeteer browsers.json at: {$configPath}\n";
