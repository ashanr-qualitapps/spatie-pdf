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
    chromium \
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
    libnss3 \
    lsb-release \
    xdg-utils \
    && rm -rf /var/lib/apt/lists/*

# Set environment variables for Puppeteer/Browsershot
ENV PUPPETEER_EXECUTABLE_PATH="/usr/bin/chromium"
ENV PUPPETEER_SKIP_CHROMIUM_DOWNLOAD=true
ENV NODE_PATH=/usr/local/lib/node_modules

# Install PHP extensions
RUN docker-php-ext-install pdo_mysql mbstring exif pcntl bcmath gd zip

# Set working directory
WORKDIR /var/www/html

# Copy existing application directory contents
COPY . /var/www/html

# Install Composer
COPY --from=composer:2.6 /usr/bin/composer /usr/bin/composer

# Install Puppeteer globally (without downloading Chromium)
RUN npm install -g puppeteer@21

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
