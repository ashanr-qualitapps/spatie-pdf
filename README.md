# Laravel Spatie PDF Application

A Laravel application demonstrating PDF generation capabilities using the Spatie PDF package with Docker containerization. This application uses Chromium via Browsershot to generate high-quality PDFs from Blade views with modern CSS support.

## Features

- **PDF Generation**: Create PDFs from Blade views using Spatie PDF package
- **Modern CSS Support**: Use Flexbox, Grid, and Tailwind CSS in your PDFs
- **Docker Environment**: Fully containerized with Docker and Docker Compose
- **Database Integration**: MySQL database for data storage
- **Headless Chromium**: Optimized for server environments

## Prerequisites

Before you begin, ensure you have the following installed:

- **Docker** (version 20.0+)
- **Docker Compose** (version 2.0+)
- **Git**

## Installation & Setup

### 1. Clone the Repository

```bash
git clone https://github.com/ashanr-qualitapps/spatie-pdf.git
cd spatie-pdf
git checkout develop
```

### 2. Environment Configuration

Create your environment file:

```bash
cp .env.example .env
```

Update the `.env` file with the following key configurations:

```env
APP_NAME="Spatie PDF App"
APP_ENV=local
APP_KEY=base64:your-generated-app-key-here
APP_DEBUG=true
APP_URL=http://localhost:8000

DB_CONNECTION=mysql
DB_HOST=mysql
DB_PORT=3307
DB_DATABASE=laravel
DB_USERNAME=ashan
DB_PASSWORD=password

# PDF Generation Configuration
PUPPETEER_EXECUTABLE_PATH=/usr/bin/chromium
PUPPETEER_SKIP_CHROMIUM_DOWNLOAD=true
NODE_PATH=/usr/local/lib/node_modules:/node_modules
NPM_PATH=/usr/bin/npm
NODE_BINARY_PATH=/usr/bin/node
```

### 3. Generate Application Key

```bash
docker-compose run --rm app php artisan key:generate
```

## Running the Application

### 1. Build and Start Services

```bash
docker-compose up -d --build
```

This command will:
- Build the Laravel application container with all PDF dependencies
- Start MySQL database service
- Set up proper networking between services

### 2. Install Dependencies

```bash
# Install PHP dependencies
docker-compose exec app composer install

# Install Node.js dependencies  
docker-compose exec app npm install

# Build frontend assets
docker-compose exec app npm run build
```

### 3. Database Setup

```bash
# Run database migrations
docker-compose exec app php artisan migrate

# Seed database (if seeders exist)
docker-compose exec app php artisan db:seed
```

### 4. Set Permissions

```bash
docker-compose exec app chown -R www-data:www-data /var/www/html/storage
docker-compose exec app chown -R www-data:www-data /var/www/html/bootstrap/cache
```

## Application Access

Once all services are running:

- **Application**: http://localhost:8000
- **MySQL**: localhost:3307 (for external connections)

## Docker Configuration

### Dockerfile Features

The application includes a specialized Dockerfile with:

- **PHP 8.2-FPM** base image
- **Chromium browser** with all required dependencies
- **System libraries** for headless PDF generation:
  - `libnss3`, `libxss1`, `libatk-bridge2.0-0`
  - `libdrm2`, `libxcomposite1`, `libxdamage1`
  - `libgbm1`, `libxkbcommon0`, `libasound2`
- **Security configurations** for safe Chromium execution
- **Non-root user** for Chromium processes

### Docker Compose Services

- **app**: Laravel application with PDF generation capabilities
- **mysql**: MySQL 8.0 database server
- **volumes**: Persistent storage for database and generated PDFs

## Usage Examples

### Basic PDF Generation

```php
use Spatie\LaravelPdf\Facades\Pdf;

// Generate PDF from view
Pdf::view('pdfs.invoice', ['invoice' => $invoice])
    ->format('a4')
    ->save('invoice.pdf');

// Return PDF as download response
return Pdf::view('pdfs.invoice', ['invoice' => $invoice])
    ->format('a4')
    ->name('invoice.pdf');
```

### Advanced PDF Options

```php
use Spatie\LaravelPdf\Facades\Pdf;

Pdf::view('pdfs.report')
    ->format('a4')
    ->margins(10, 10, 10, 10)
    ->headerView('pdfs.header')
    ->footerView('pdfs.footer')
    ->save('report.pdf');
```

## Available Commands

### Development Commands

```bash
# View application logs
docker-compose logs -f app

# Access application shell
docker-compose exec app bash

# Run artisan commands
docker-compose exec app php artisan [command]

# Run tests
docker-compose exec app php artisan test
```

### PDF Testing

```bash
# Test PDF generation
docker-compose exec app php artisan tinker
>>> use Spatie\LaravelPdf\Facades\Pdf;
>>> Pdf::html('<h1>Test PDF</h1>')->save('test.pdf');
```

## Troubleshooting

### Common Issues

#### 1. Chromium Not Found
```bash
# Check Chromium installation
docker-compose exec app which chromium
docker-compose exec app chromium --version
```

#### 2. Puppeteer Not Found
If you encounter the error "Cannot find module 'puppeteer'" or see warnings about NODE_PATH, use one of these methods:

```bash
# Method 1: Set NODE_PATH in the command
docker-compose exec -e NODE_PATH=/usr/local/lib/node_modules:/node_modules app npm install

# Method 2: Source the environment file first
docker-compose exec app bash -c 'source /etc/profile.d/node_path.sh && npm install'

# Verify NODE_PATH is correctly set
docker-compose exec app bash -c 'echo $NODE_PATH'
# Should output: /usr/local/lib/node_modules:/node_modules
```

#### 3. Permission Errors
```bash
# Fix storage permissions
docker-compose exec app chown -R www-data:www-data storage/
docker-compose exec app chmod -R 775 storage/
```

#### 4. Database Connection Issues
```bash
# Check MySQL service status
docker-compose ps mysql

# View MySQL logs
docker-compose logs mysql
```

#### 5. PDF Generation Timeouts
If experiencing timeout issues in production:

```php
use Spatie\LaravelPdf\Facades\Pdf;

Pdf::view('pdfs.invoice')
    ->timeout(120) // Increase timeout to 120 seconds
    ->save('invoice.pdf');
```

### Environment-Specific Issues

#### Production Deployment
For production environments, consider:

- Using `noSandbox()` only if you trust the content
- Increasing protocol timeout for complex PDFs
- Ensuring proper Chromium dependencies are installed

## Development

### Adding New PDF Templates

1. Create Blade view in `resources/views/pdfs/`
2. Style with modern CSS (Tailwind supported)
3. Test generation with appropriate data
4. Add route and controller method

### Testing PDF Generation

```php
use Spatie\LaravelPdf\Facades\Pdf;
it('can generate invoice PDF', function () {
    Pdf::fake();

    $response = $this->get('/download-invoice/1');

    Pdf::assertRespondedWithPdf(function (PdfBuilder $pdf) {
        return $pdf->contains('Invoice');
    });
});
```

## Restarting After Changes

When you make changes to your application code or Docker configuration, you may need to restart your containers:

### For Code Changes Only

If you've only changed application code (PHP files, Blade templates, etc.):

```bash
# Restart the app container
docker-compose restart app
```

### For Dependency Changes

If you've updated Composer or NPM dependencies:

```bash
# Restart and rebuild the application
docker-compose down
docker-compose up -d
docker-compose exec app composer install
docker-compose exec app npm install
docker-compose exec app npm run build
```

### For Dockerfile or Docker Compose Changes

If you've modified the Dockerfile or docker-compose.yml:

```bash
# Fully rebuild containers
docker-compose down
docker-compose up -d --build
```

### Verify Services

Check if all services are running correctly:

```bash
# View all running containers
docker-compose ps

# Check container logs for errors
docker-compose logs -f app
```

## Support

For issues related to:
- **Spatie PDF Package**: [Official Documentation](https://spatie.be/docs/laravel-pdf)
- **Docker Configuration**: Check container logs and ensure all dependencies are installed
- **Application Issues**: Review Laravel logs in `storage/logs/`

## License

This project is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
