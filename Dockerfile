FROM php:8.2-fpm

# Install system dependencies
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
    chromium

# Install PHP extensions
RUN docker-php-ext-install pdo_mysql mbstring exif pcntl bcmath gd zip

# Set working directory
WORKDIR /var/www/html

# Copy existing application directory contents
COPY . /var/www/html

# Install Composer
COPY --from=composer:2.6 /usr/bin/composer /usr/bin/composer

# Install Node dependencies
RUN npm install

# Set permissions
RUN chown -R www-data:www-data /var/www/html

# Expose port 8000 and start Laravel server
EXPOSE 8000
CMD php artisan serve --host=0.0.0.0 --port=8000
