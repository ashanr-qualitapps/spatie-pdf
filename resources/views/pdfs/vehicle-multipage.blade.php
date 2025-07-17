<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $vehicle['make'] ?? '' }} {{ $vehicle['model'] ?? '' }} - QUADIS.es</title>
</head>
<body>
    <!-- This template combines the three pages for rendering -->
    
    <!-- Page 1 -->
    @include('pdfs.vehicle-page1', ['vehicle' => $vehicle])
    
    <!-- Page 2 -->
    @include('pdfs.vehicle-page2', ['vehicle' => $vehicle])
    
    <!-- Page 3 -->
    @include('pdfs.vehicle-page3', ['vehicle' => $vehicle])
</body>
</html>
