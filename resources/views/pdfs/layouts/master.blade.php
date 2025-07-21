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
            margin: 0 ;
            padding: 15mm;
        }

        /* Header Styles */

        .header {
            background-color: #f8f9fa;
            padding: 10px 20px;
            border-bottom: 2px solid #e0e0e0;
            text-align: center;
        }        .contact-info {
            text-align: right;
            color: #666;
        }

        .phone {
            font-size: 14px;
            font-weight: bold;
            color: #2c5aa0;
        }

        /* Vehicle Header */
       

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

      

        /* Responsive adjustments for PDF */
        @media print {

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