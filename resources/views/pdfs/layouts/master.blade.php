<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Vehicle Information')</title>
    <style>
        /* Common styles */
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            color: #333;
            margin: 0;
            padding: 20px;
            background-color: #f9f9f9;
        }
        
        /* Add padding for header and footer space */
        .page {
            padding-top: 70px; /* Space for header */
            padding-bottom: 50px; /* Space for footer */
        }
        
        .document-container {
            max-width: 800px;
            margin: 0 auto;
            background-color: #fff;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
            padding: 30px;
            border-radius: 5px;
        }
        
        .content-header {
            background-color: #2c3e50;
            color: white;
            padding: 20px;
            margin: -30px -30px 20px -30px;
            border-radius: 5px 5px 0 0;
            display: flex;
            justify-content: space-between;
        }
        
        .content-header h1 {
            margin: 0;
            font-size: 24px;
        }
        
        .logo-area {
            text-align: right;
        }
        
        .content-section {
            margin-bottom: 30px;
        }
        
        .section-title {
            border-bottom: 2px solid #2c3e50;
            padding-bottom: 5px;
            margin-bottom: 15px;
            color: #2c3e50;
        }
        
        .meta-info {
            background-color: #f5f5f5;
            padding: 15px;
            border-radius: 5px;
            margin-bottom: 20px;
        }
        
        table {
            width: 100%;
            border-collapse: collapse;
        }
        
        table th, table td {
            padding: 10px;
            border-bottom: 1px solid #eee;
        }
        
        table th {
            text-align: left;
            background-color: #f5f5f5;
            font-weight: bold;
        }
        
        .document-footer {
            margin-top: 30px;
            text-align: center;
            font-size: 12px;
            color: #777;
            border-top: 1px solid #eee;
            padding-top: 20px;
        }

        /* Additional custom styles can be added here */
        @yield('styles')
    </style>
</head>
<body>
    <div class="page">
        <div class="document-container">
            <div class="content-header">
                <h1>Vehicle Information System</h1>
                <div class="logo-area">PDF Report</div>
            </div>
            
            <div class="meta-info">
                <p><strong>Reference ID:</strong> {{ $id ?? 'N/A' }}</p>
                <p><strong>Generated:</strong> {{ date('Y-m-d H:i:s') }}</p>
            </div>
            
            <div class="main-content">
                @yield('content')
            </div>
            
            <div class="document-footer">
                <p>This document was automatically generated on {{ date('Y-m-d') }}.</p>
                <p>© {{ date('Y') }} Vehicle Information System. All rights reserved.</p>
            </div>
        </div>
    </div>
    
    <!-- Additional scripts if needed -->
    @yield('scripts')
</body>
</html>
