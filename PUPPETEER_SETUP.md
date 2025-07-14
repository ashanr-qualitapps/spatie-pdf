# Puppeteer Setup for PDF Generation

The PDF generation in this application uses Spatie's Laravel PDF package which relies on Puppeteer/Browsershot.
To make it work properly, follow these steps:

## Installation Requirements

1. Install Node.js and NPM if not already installed:
   - Download from [nodejs.org](https://nodejs.org/)
   - Verify installation with `node -v` and `npm -v`

2. Install Puppeteer globally:
   ```
   npm install -g puppeteer
   ```

3. Or install it in your project:
   ```
   npm install puppeteer
   ```

## Configuration Options

1. Set Chrome/Chromium path in your `.env` file:
   ```
   CHROME_PATH=/path/to/chrome
   ```
   
   Common paths:
   - Windows: `C:\Program Files\Google\Chrome\Application\chrome.exe`
   - Mac: `/Applications/Google Chrome.app/Contents/MacOS/Google Chrome`
   - Linux: `/usr/bin/google-chrome`

2. If you're on a server without a GUI, you might need additional packages for Chrome to run:
   ```
   apt-get install -y libx11-xcb1 libxcomposite1 libxcursor1 libxdamage1 libxi6 libxtst6 libnss3 libcups2 libxss1 libxrandr2 libasound2 libatk1.0-0 libgtk-3-0
   ```

## Troubleshooting

If you encounter the ProcessFailedException:

1. Verify Node.js is installed and in PATH
2. Check if Puppeteer is installed correctly
3. Make sure Chrome/Chromium is accessible
4. Ensure temp directories have proper permissions
5. Try running with the `--no-sandbox` flag (already configured in config/pdf.php)
6. For Windows systems, you might need to disable Windows Defender or add exceptions

For more information, refer to:
- [Spatie Laravel PDF Documentation](https://spatie.be/docs/laravel-pdf)
- [Browsershot Documentation](https://github.com/spatie/browsershot)
- [Puppeteer Documentation](https://pptr.dev/)
