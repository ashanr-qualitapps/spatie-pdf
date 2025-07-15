<?php

return [
    /*
    |--------------------------------------------------------------------------
    | Chrome/Chromium Path
    |--------------------------------------------------------------------------
    |
    | Path to Chrome/Chromium executable. If empty, Browsershot will try
    | to find it automatically using the following paths:
    |
    | Windows: C:\Program Files\Google\Chrome\Application\chrome.exe
    | macOS: /Applications/Google Chrome.app/Contents/MacOS/Google Chrome
    | Linux: /usr/bin/google-chrome
    |
    */
    'chrome_path' => env('PUPPETEER_EXECUTABLE_PATH', '/usr/bin/chromium'),

    /*
    |--------------------------------------------------------------------------
    | Node Binary Path
    |--------------------------------------------------------------------------
    |
    | The path to the Node.js binary. If empty, Browsershot will try to use
    | the Node.js binary that is in your system's PATH.
    |
    */
    'node_binary_path' => env('NODE_BINARY_PATH', '/usr/bin/node'),

    /*
    |--------------------------------------------------------------------------
    | NPM Binary Path
    |--------------------------------------------------------------------------
    |
    | The path to the NPM binary. If empty, Browsershot will try to use
    | the NPM binary that is in your system's PATH.
    |
    */
    'npm_binary_path' => env('NPM_BINARY_PATH', '/usr/bin/npm'),

    /*
    |--------------------------------------------------------------------------
    | Chrome/Chromium Sandbox
    |--------------------------------------------------------------------------
    |
    | Whether to use the Chrome/Chromium sandbox. Useful on certain Linux
    | distributions where sandbox is not working.
    |
    */
    'no_sandbox' => env('CHROME_NO_SANDBOX', true),

    /*
    |--------------------------------------------------------------------------
    | Default Paper Size
    |--------------------------------------------------------------------------
    |
    | The default paper size to use for PDFs. You can use any of the
    | standard paper sizes: a0-a10, b0-b10, c0-c10, letter, legal,
    | junior-legal, ledger, tabloid, executive, folio, etc.
    |
    */
    'default_paper_size' => 'a4',

    /*
    |--------------------------------------------------------------------------
    | Default Paper Orientation
    |--------------------------------------------------------------------------
    |
    | The default paper orientation to use for PDFs.
    | Available options: 'portrait', 'landscape'
    |
    */
    'default_paper_orientation' => 'portrait',

    /*
    |--------------------------------------------------------------------------
    | Default Font Family
    |--------------------------------------------------------------------------
    |
    | The default font family to use for PDFs.
    |
    */
    'default_font_family' => 'sans-serif',

    /*
    |--------------------------------------------------------------------------
    | Browsershot Options
    |--------------------------------------------------------------------------
    |
    | Default Browsershot options that will be applied to all PDFs.
    |
    */
    'browsershot_options' => [
        'ignoreHttpsErrors' => true,
        'timeout' => 30,
        'margins' => [
            'top' => 20,
            'right' => 20,
            'bottom' => 20,
            'left' => 20,
        ],
    ],
];
