#!/bin/bash

# Script to install and configure Chrome for Puppeteer

echo "Installing Google Chrome..."

# Add Google Chrome repository
wget -q -O - https://dl-ssl.google.com/linux/linux_signing_key.pub | gpg --dearmor > /etc/apt/trusted.gpg.d/google-archive.gpg
echo "deb [arch=amd64] http://dl.google.com/linux/chrome/deb/ stable main" > /etc/apt/sources.list.d/google-chrome.list

# Update package list and install Chrome
apt-get update
apt-get install -y google-chrome-stable --no-install-recommends

# Verify installation
if [ -f "/usr/bin/google-chrome" ]; then
    echo "Chrome installed successfully at /usr/bin/google-chrome"
    /usr/bin/google-chrome --version
else
    echo "Chrome installation failed"
    exit 1
fi

# Set proper permissions
chmod +x /usr/bin/google-chrome

# Create symlinks for compatibility
ln -sf /usr/bin/google-chrome /usr/bin/chrome
ln -sf /usr/bin/google-chrome /usr/bin/chromium

echo "Chrome installation and configuration completed!"
