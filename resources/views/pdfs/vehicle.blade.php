<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Vehicle Information</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            color: #333;
            margin: 0;
            padding: 20px;
        }
        .container {
            max-width: 800px;
            margin: 0 auto;
        }
        .header {
            text-align: center;
            margin-bottom: 30px;
            padding-bottom: 20px;
            border-bottom: 1px solid #ddd;
        }
        h1 {
            color: #2c3e50;
        }
        .vehicle-info {
            margin-bottom: 30px;
        }
        .vehicle-info table {
            width: 100%;
            border-collapse: collapse;
        }
        .vehicle-info th {
            text-align: left;
            background-color: #f5f5f5;
            padding: 10px;
        }
        .vehicle-info td {
            padding: 10px;
            border-bottom: 1px solid #eee;
        }
        .footer {
            margin-top: 50px;
            text-align: center;
            font-size: 12px;
            color: #777;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>Vehicle Information Report</h1>
            <p>Vehicle ID: {{ $id ?? 'N/A' }}</p>
            <p>Report generated on: {{ date('Y-m-d H:i:s') }}</p>
        </div>

        <div class="vehicle-info">
            <h2>Vehicle Details</h2>
            <table>
                <tr>
                    <th>Make</th>
                    <td>{{ $vehicle['make'] ?? 'N/A' }}</td>
                    <th>Model</th>
                    <td>{{ $vehicle['model'] ?? 'N/A' }}</td>
                </tr>
                <tr>
                    <th>Year</th>
                    <td>{{ $vehicle['year'] ?? 'N/A' }}</td>
                    <th>Color</th>
                    <td>{{ $vehicle['color'] ?? 'N/A' }}</td>
                </tr>
                <tr>
                    <th>VIN</th>
                    <td>{{ $vehicle['vin'] ?? 'N/A' }}</td>
                    <th>License Plate</th>
                    <td>{{ $vehicle['license_plate'] ?? 'N/A' }}</td>
                </tr>
                <tr>
                    <th>Mileage</th>
                    <td>{{ $vehicle['mileage'] ?? 'N/A' }}</td>
                    <th>Status</th>
                    <td>{{ $vehicle['status'] ?? 'N/A' }}</td>
                </tr>
            </table>
        </div>

        @if(!empty($vehicle['features']))
        <div class="vehicle-info">
            <h2>Features</h2>
            <ul>
                @foreach($vehicle['features'] as $feature)
                <li>{{ $feature }}</li>
                @endforeach
            </ul>
        </div>
        @endif

        @if(!empty($vehicle['description']))
        <div class="vehicle-info">
            <h2>Description</h2>
            <p>{{ $vehicle['description'] }}</p>
        </div>
        @endif

        <div class="footer">
            <p>This document was automatically generated. Please verify all information for accuracy.</p>
        </div>
    </div>
</body>
</html>
