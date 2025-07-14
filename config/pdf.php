<?php

return [
    /*
    |--------------------------------------------------------------------------
    | Chrome/Chromium Path
    |--------------------------------------------------------------------------
    |
    | This is the absolute path to the Chrome or Chromium executable.
    | If not set, Browsershot will try to detect the location automatically.
    | You can also use `npm install puppeteer` to use the installed version.
    |
    */
    'chrome_path' => env('CHROME_PATH'),

    /*
    |--------------------------------------------------------------------------
    | Paper Configuration
    |--------------------------------------------------------------------------
    |
    | This option allows you to configure the default paper size and orientation.
    |
    */
    'paper' => 'a4',
    'orientation' => 'portrait',

    /*
    |--------------------------------------------------------------------------
    | Storage Configuration
    |--------------------------------------------------------------------------
    |
    | Here you can specify the temporary storage disk and path.
    |
    */
    'storage_disk' => env('PDF_STORAGE_DISK', 'local'),
    'storage_path' => env('PDF_STORAGE_PATH', 'pdf'),
    
    /*
    |--------------------------------------------------------------------------
    | Chrome/Puppeteer Options
    |--------------------------------------------------------------------------
    |
    | Here you can specify additional options for Chrome/Puppeteer.
    |
    */
    'chrome_args' => [
        '--disable-gpu',
        '--disable-setuid-sandbox',
        '--no-sandbox',
    ],
    
    /*
    |--------------------------------------------------------------------------
    | Browsershot Options
    |--------------------------------------------------------------------------
    |
    | Additional options for Browsershot.
    |
    */
    'timeout' => 60,
];
