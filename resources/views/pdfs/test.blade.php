<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title }}</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 30px;
            line-height: 1.6;
        }
        .header {
            text-align: center;
            margin-bottom: 30px;
            padding-bottom: 10px;
            border-bottom: 1px solid #ddd;
        }
        .content {
            margin-bottom: 30px;
        }
        .footer {
            text-align: center;
            font-size: 12px;
            color: #666;
            margin-top: 50px;
            padding-top: 10px;
            border-top: 1px solid #ddd;
        }
    </style>
</head>
<body>
    <div class="header">
        <h1>{{ $title }}</h1>
        <p>ID: {{ $id }}</p>
        <p>Date: {{ $date }}</p>
    </div>
    
    <div class="content">
        <p>{{ $content }}</p>
        <p>This PDF was generated using Spatie Laravel PDF package with Browsershot.</p>
    </div>
    
    <div class="footer">
        <p>Generated at: {{ now() }}</p>
    </div>
</body>
</html>
