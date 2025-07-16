<!DOCTYPE html>
<html>
<head>
    <style>
        .pdf-header {
            padding: 10px;
            font-family: Arial, sans-serif;
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            height: 50px;
            background-color: white;
            border-bottom: 1px solid #ddd;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }
        .header-content {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        .logo {
            font-size: 18px;
            font-weight: bold;
            color: #2c3e50;
        }
        .document-info {
            text-align: right;
            font-size: 11px;
            color: #555;
        }
    </style>
</head>
<body>
    <div class="pdf-header">
        <div class="header-content">
            <div class="logo">
                Vehicle Information System
            </div>
            <div class="document-info">
                <p style="margin: 0">Vehicle ID: {{ $id ?? 'N/A' }}</p>
                <p style="margin: 0">Generated: {{ date('Y-m-d H:i') }}</p>
            </div>
        </div>
    </div>
</body>
</html>
