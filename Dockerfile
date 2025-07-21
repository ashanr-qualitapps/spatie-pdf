FROM php:8.2-fpm

# Install system dependencies including those required for Spatie PDF/Browsershot
RUN apt-get update && apt-get install -y \
    git \
    curl \
    zip \
    unzip \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    libzip-dev \
    nodejs \
    npm \
    wget \
    gnupg \
    # Additional dependencies for Spatie PDF/Browsershot
    libnss3 \
    libxss1 \
    libatk-bridge2.0-0 \
    libdrm2 \
    libxcomposite1 \
    libxdamage1 \
    libxrandr2 \
    libgbm1 \
    libxkbcommon0 \
    libasound2 \
    libatspi2.0-0 \
    libgtk-3-0 \
    ca-certificates \
    fonts-liberation \
    libappindicator3-1 \
    lsb-release \
    xdg-utils \
    && rm -rf /var/lib/apt/lists/*

# Install Google Chrome Stable
RUN wget -q -O - https://dl-ssl.google.com/linux/linux_signing_key.pub | gpg --dearmor > /etc/apt/trusted.gpg.d/google-archive.gpg && \
    echo "deb [arch=amd64] http://dl.google.com/linux/chrome/deb/ stable main" > /etc/apt/sources.list.d/google-chrome.list && \
    apt-get update && \
    apt-get install -y google-chrome-stable --no-install-recommends && \
    rm -rf /var/lib/apt/lists/*

# Set environment variables for Puppeteer/Browsershot
ENV PUPPETEER_EXECUTABLE_PATH=/usr/bin/google-chrome
ENV PUPPETEER_SKIP_CHROMIUM_DOWNLOAD=true
ENV NODE_PATH=/usr/local/lib/node_modules
ENV NODE_BINARY_PATH=/usr/bin/node
ENV CHROME_PATH=/usr/bin/google-chrome

# Create symlinks for Chrome executables to ensure compatibility
RUN ln -sf /usr/bin/google-chrome /usr/bin/chrome && \
    ln -sf /usr/bin/google-chrome /usr/bin/chromium && \
    chmod +x /usr/bin/google-chrome /usr/bin/chrome /usr/bin/chromium

# Install PHP extensions
RUN docker-php-ext-install pdo_mysql mbstring exif pcntl bcmath gd zip

# Set working directory
WORKDIR /var/www/html

# Copy existing application directory contents
COPY . /var/www/html

# Install Composer
COPY --from=composer:2.6 /usr/bin/composer /usr/bin/composer

# Install Puppeteer globally
RUN npm install -g puppeteer@21 && \
    npm list -g puppeteer

# Install PHP dependencies (including Spatie PDF)
RUN composer install --no-dev --optimize-autoloader

# Install Node dependencies
RUN npm install

# Create a non-root user for running Chromium
RUN groupadd -r pptruser && useradd -r -g pptruser -G audio,video pptruser \
    && mkdir -p /home/pptruser/Downloads \
    && chown -R pptruser:pptruser /home/pptruser

# Set permissions
RUN chown -R www-data:www-data /var/www/html

# Expose port 8000 and start Laravel server
EXPOSE 8000
CMD php artisan serve --host=0.0.0.0 --port=8000
