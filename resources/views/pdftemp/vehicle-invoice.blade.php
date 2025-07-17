<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>QUADIS.es - {{ $vehicle['make'] ?? '' }} {{ $vehicle['model'] ?? '' }}</title>
    <style>
        @page {
            margin: 80px 0 100px 0;
            size: A4;
        }
        
        @media print {
            .quadis-header, .quadis-footer {
                -webkit-print-color-adjust: exact;
                color-adjust: exact;
            }
            
            body {
                margin: 0;
                padding: 0;
            }
        }
        
        * {
            box-sizing: border-box;
        }
        
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            color: #232323;
            background: #fff;
        }
    </style>
</head>
<body>
    @include('pdftemp.header')
    
    @include('pdftemp.middle-page-1')
    @include('pdftemp.middle-page-2')
    @include('pdftemp.middle-page-3')
    
    @include('pdftemp.footer')
</body>
</html>
