<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Invoice #{{ $invoice->invoice_number }}</title>
    <style>
        body {
            font-family: 'Helvetica', 'Arial', sans-serif;
            margin: 0;
            padding: 20px;
            color: #333;
        }
        .invoice-header {
            text-align: center;
            margin-bottom: 30px;
            padding-bottom: 20px;
            border-bottom: 1px solid #eee;
        }
        .invoice-header h1 {
            margin-bottom: 5px;
            color: #2563eb;
            font-size: 28px;
        }
        .invoice-header p {
            color: #666;
            margin: 0;
        }
        .invoice-details {
            margin-bottom: 30px;
        }
        .client-info {
            margin-bottom: 20px;
        }
        .meta-info {
            display: flex;
            justify-content: space-between;
            margin-bottom: 20px;
        }
        .meta-info div {
            flex: 1;
        }
        .invoice-details table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        .invoice-details table th, 
        .invoice-details table td {
            padding: 12px;
            border: 1px solid #ddd;
            text-align: left;
        }
        .invoice-details table th {
            background-color: #f3f4f6;
        }
        .invoice-footer {
            margin-top: 50px;
            text-align: center;
            font-size: 12px;
            color: #777;
            padding-top: 20px;
            border-top: 1px solid #eee;
        }
        .total {
            font-size: 18px;
            font-weight: bold;
            text-align: right;
            padding: 10px 0;
        }
    </style>
</head>
<body>
    <div class="invoice-header">
        <h1>INVOICE</h1>
        <p>Invoice #{{ $invoice->invoice_number }}</p>
        <p>{{ $invoice->title }}</p>
    </div>
    
    <div class="invoice-details">
        <div class="client-info">
            <h3>Billed To:</h3>
            <p>{{ $invoice->client_name }}</p>
            @if($invoice->client_email)
                <p>{{ $invoice->client_email }}</p>
            @endif
        </div>
        
        <div class="meta-info">
            <div>
                <p><strong>Issue Date:</strong> {{ $invoice->issue_date->format('F j, Y') }}</p>
                <p><strong>Due Date:</strong> {{ $invoice->due_date->format('F j, Y') }}</p>
            </div>
            <div>
                <p><strong>Status:</strong> {{ ucfirst($invoice->status) }}</p>
            </div>
        </div>
        
        <table>
            <thead>
                <tr>
                    <th>Description</th>
                    <th style="width: 20%;">Amount</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>{{ $invoice->title }}</td>
                    <td>${{ number_format($invoice->total_amount, 2) }}</td>
                </tr>
                <!-- If you have invoice items, you could loop through them here -->
            </tbody>
        </table>
        
        <div class="total">
            Total: ${{ number_format($invoice->total_amount, 2) }}
        </div>
    </div>
    
    <div class="invoice-footer">
        <p>Thank you for your business!</p>
    </div>
</body>
</html>
