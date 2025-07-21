#!/bin/bash

# Script to register Chrome with Puppeteer and fix PDF generation issues

# Set environment variables
export NODE_PATH=/usr/local/lib/node_modules:/node_modules
export PUPPETEER_EXECUTABLE_PATH=${PUPPETEER_EXECUTABLE_PATH:-/usr/bin/chromium}

echo "Using Chrome at: $PUPPETEER_EXECUTABLE_PATH"
echo "NODE_PATH: $NODE_PATH"

# Check if Chrome exists
if [ ! -f "$PUPPETEER_EXECUTABLE_PATH" ]; then
  echo "Chrome not found at $PUPPETEER_EXECUTABLE_PATH"
  echo "Searching for Chrome..."
  
  # Search for Chrome in common locations
  CHROME_PATHS=(
    "/usr/bin/chromium"
    "/usr/bin/chromium-browser"
    "/usr/bin/chrome"
    "/usr/bin/google-chrome"
    "/usr/local/bin/chromium"
    "/usr/local/bin/chrome"
    "/usr/local/bin/google-chrome"
  )
  
  for path in "${CHROME_PATHS[@]}"; do
    if [ -f "$path" ]; then
      export PUPPETEER_EXECUTABLE_PATH=$path
      echo "Found Chrome at: $PUPPETEER_EXECUTABLE_PATH"
      break
    fi
  done
fi

# Create Puppeteer cache directory
mkdir -p ~/.cache/puppeteer
echo "Created Puppeteer cache directory"

# Create a file to manually register chrome with Puppeteer
cat > register-chrome.js << EOL
const fs = require('fs');
const path = require('path');

const chromePath = process.env.PUPPETEER_EXECUTABLE_PATH || '/usr/bin/chromium';
console.log(\`Registering Chrome at: \${chromePath}\`);

// Create the puppeteer config directory if it doesn't exist
const homeDir = process.env.HOME || '/root';
const puppeteerConfigDir = path.join(homeDir, '.cache', 'puppeteer');
if (!fs.existsSync(puppeteerConfigDir)) {
    fs.mkdirSync(puppeteerConfigDir, { recursive: true });
}

// Create a browsers.json file to register the browser
const browsersJsonPath = path.join(puppeteerConfigDir, 'browsers.json');
const browserConfig = {
    "browsers": [
        {
            "name": "chrome",
            "revision": "121.0.6167.85",
            "installPath": path.dirname(chromePath),
            "executablePath": chromePath
        }
    ]
};

fs.writeFileSync(browsersJsonPath, JSON.stringify(browserConfig, null, 2));
console.log(\`Created browsers.json at: \${browsersJsonPath}\`);
console.log('Chrome registration complete!');
EOL

# Run the registration script
node register-chrome.js
