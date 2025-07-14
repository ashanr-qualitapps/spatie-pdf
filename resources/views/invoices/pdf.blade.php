<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Invoice #{{ $invoice->id }}</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 20px;
        }
        .invoice-header {
            text-align: center;
            margin-bottom: 30px;
        }
        .invoice-header h1 {
            margin-bottom: 5px;
            color: #333;
        }
        .invoice-details {
            margin-bottom: 20px;
        }
        .invoice-details table {
            width: 100%;
            border-collapse: collapse;
        }
        .invoice-details table th, 
        .invoice-details table td {
            padding: 8px;
            border: 1px solid #ddd;
            text-align: left;
        }
        .invoice-footer {
            margin-top: 50px;
            text-align: center;
            font-size: 12px;
            color: #777;
        }
    </style>
</head>
<body>
    <div class="invoice-header">
        <h1>INVOICE</h1>
        <p>Invoice #{{ $invoice->id }}</p>
    </div>
    
    <div class="invoice-details">
        <p><strong>Date:</strong> {{ $invoice->created_at->format('F j, Y') }}</p>
        
        <table>
            <thead>
                <tr>
                    <th>Description</th>
                    <th>Amount</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>Invoice ID #{{ $invoice->id }}</td>
                    <td>$0.00</td>
                </tr>
            </tbody>
        </table>
    </div>
    
    <div class="invoice-footer">
        <p>Thank you for your business!</p>
    </div>
</body>
</html>
