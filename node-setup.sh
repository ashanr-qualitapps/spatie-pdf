#!/bin/bash

# Script to ensure NODE_PATH and other Node.js related environment variables are properly set

# Set NODE_PATH
export NODE_PATH=/usr/local/lib/node_modules:/node_modules

# Check if puppeteer is installed
if [ ! -d "/usr/local/lib/node_modules/puppeteer" ] && [ ! -d "/node_modules/puppeteer" ]; then
  echo "Puppeteer not found. Installing globally..."
  npm install -g puppeteer@21
fi

# Show confirmation
echo "NODE environment setup complete:"
echo "NODE_PATH = $NODE_PATH"
echo "Puppeteer status:"
npm list -g puppeteer

# Execute the provided command with proper environment
exec "$@"
