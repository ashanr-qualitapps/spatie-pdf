<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'QUADIS.es - Información del Vehículo')</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }


        body {
            font-family: 'Arial', sans-serif;
            font-size: 12px;
            line-height: 1.4;
            color: #333;
            background: #fff;
            padding-top: 70px; /* Add global top padding to prevent header overlap */
        }
        
        /* Ensure each page has top padding after page break */
        .page-break {
            page-break-before: always;
            height: 1px; /* Minimal height */
        }
        
        .page-break::after {
            content: "";
            display: block;
            height: 70px; /* Space after page break */
        }

        .container {
            max-width: 210mm;
            margin: 0 auto;
            padding: 15mm;
        }

        /* Header Styles */

        .logo {
            font-size: 24px;
            font-weight: bold;
            color: #2c5aa0;
        }

        .contact-info {
            text-align: right;
            color: #666;
        }

        .phone {
            font-size: 14px;
            font-weight: bold;
            color: #2c5aa0;
        }

        /* Vehicle Header */
        .vehicle-header {
            background: linear-gradient(135deg, #449941ff 0%, #1a8028ff 100%);
            color: white;
            padding: 20px;
            margin-bottom: 20px;
            border-radius: 8px;
        }

        .vehicle-title {
            font-size: 18px;
            font-weight: bold;
            margin-bottom: 5px;
        }

        .vehicle-version {
            font-size: 14px;
            opacity: 0.9;
            margin-bottom: 10px;
        }

        .vehicle-meta {
            display: flex;
            justify-content: space-between;
            align-items: center;
            flex-wrap: wrap;
        }

        .ref-number {
            font-size: 12px;
            opacity: 0.8;
        }

        .fuel-type {
            background: rgba(255, 255, 255, 0.2);
            padding: 4px 8px;
            border-radius: 4px;
            font-size: 11px;
        }

        .warranty {
            background: #28a745;
            padding: 4px 8px;
            border-radius: 4px;
            font-size: 11px;
        }

        /* Price Section */
        .price-section {
            background: #f8f9fa;
            padding: 20px;
            margin-bottom: 20px;
            border-radius: 8px;
            border-left: 4px solid #2c5aa0;
        }

        .price-grid {
            display: grid;
            grid-template-columns: 1fr 1fr 1fr;
            gap: 20px;
            align-items: center;
        }

        .price-item {
            text-align: center;
        }

        .price-label {
            font-size: 11px;
            color: #666;
            margin-bottom: 5px;
        }

        .price-value {
            font-size: 18px;
            font-weight: bold;
            color: #2c5aa0;
        }

        .price-value.financed {
            color: #28a745;
        }

        .price-value.monthly {
            color: #dc3545;
        }

        /* Image Section */
        .image-section {
            margin-bottom: 20px;
        }

        .main-image {
            width: 100%;
            height: 200px;
            object-fit: cover;
            border-radius: 8px;
            border: 2px solid #e0e0e0;
        }

        /* Characteristics Table */
        .characteristics-section {
            margin-bottom: 20px;
        }

        .section-title {
            font-size: 16px;
            font-weight: bold;
            color: #2c5aa0;
            margin-bottom: 15px;
            padding-bottom: 5px;
            border-bottom: 2px solid #2c5aa0;
        }

        .characteristics-table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        .characteristics-table td {
            padding: 8px 12px;
            border: 1px solid #ddd;
            vertical-align: top;
        }

        .characteristics-table td:first-child,
        .characteristics-table td:nth-child(3) {
            background: #f8f9fa;
            font-weight: bold;
            color: #2c5aa0;
            width: 25%;
        }

        .characteristics-table td:nth-child(2),
        .characteristics-table td:nth-child(4) {
            width: 25%;
        }

        /* Technical Specs */
        .tech-specs {
            display: grid;
            grid-template-columns: 1fr 1fr 1fr;
            gap: 20px;
            margin-bottom: 20px;
        }

        .spec-group {
            background: #f8f9fa;
            padding: 15px;
            border-radius: 8px;
            border-left: 4px solid #2c5aa0;
        }

        .spec-title {
            font-size: 14px;
            font-weight: bold;
            color: #2c5aa0;
            margin-bottom: 10px;
        }

        .spec-item {
            display: flex;
            justify-content: space-between;
            margin-bottom: 5px;
        }

        .spec-label {
            color: #666;
            font-size: 11px;
        }

        .spec-value {
            font-weight: bold;
            color: #333;
            font-size: 11px;
        }

        /* Description */
        .description-section {
            margin-bottom: 20px;
        }

        .description-content {
            background: #f8f9fa;
            padding: 15px;
            border-radius: 8px;
            line-height: 1.6;
            font-size: 11px;
        }

        .description-content h3 {
            color: #2c5aa0;
            font-size: 14px;
            margin-bottom: 10px;
        }

        .description-content p {
            margin-bottom: 10px;
        }

        /* Images Gallery */
        .images-gallery {
            margin-bottom: 20px;
        }

        .gallery-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 10px;
        }

        .gallery-image {
            width: 100%;
            height: 100px;
            object-fit: cover;
            border-radius: 4px;
            border: 1px solid #ddd;
        }

        /* Footer */
        .footer {
            margin-top: 30px;
            padding-top: 20px;
            border-top: 1px solid #e0e0e0;
            font-size: 10px;
            color: #666;
        }

        .legal-notice {
            background: #f8f9fa;
            padding: 15px;
            border-radius: 4px;
            margin-bottom: 10px;
        }

        .legal-notice h4 {
            color: #2c5aa0;
            margin-bottom: 10px;
        }

        .contact-footer {
            text-align: center;
            margin-top: 15px;
        }

        .contact-footer .logo {
            font-size: 16px;
            margin-bottom: 5px;
        }

        .contact-footer .phone {
            font-size: 12px;
        }

        /* Environmental Label */
        .env-label {
            background: #28a745;
            color: white;
            padding: 2px 6px;
            border-radius: 4px;
            font-size: 10px;
            font-weight: bold;
        }

        .env-label.label-0 {
            background: #007bff;
        }

        .env-label.label-eco {
            background: #28a745;
        }

        .env-label.label-c {
            background: #ffc107;
            color: #000;
        }

        /* Responsive adjustments for PDF */
        @media print {
            .container {
                padding: 10mm;
            }

            .page-break {
                page-break-before: always;
            }
        }

        /* Additional styling for better PDF rendering */
        .highlight {
            background: #fff3cd;
            padding: 2px 4px;
            border-radius: 2px;
        }

        .badge {
            display: inline-block;
            padding: 2px 6px;
            border-radius: 4px;
            font-size: 10px;
            font-weight: bold;
        }

        .badge-success {
            background: #28a745;
            color: white;
        }

        .badge-info {
            background: #17a2b8;
            color: white;
        }

        .badge-warning {
            background: #ffc107;
            color: #000;
        }
    </style>
    @yield('styles')
</head>
<body>
    <div class="container">
        <!-- Content -->
        @yield('content')   
    </div>

    @yield('scripts')
</body>
</html>