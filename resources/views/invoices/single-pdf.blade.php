<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Invoice {{ $invoice->invoice_number }}</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 20px;
            color: #333;
        }
        .header {
            text-align: center;
            margin-bottom: 30px;
            padding-bottom: 20px;
            border-bottom: 2px solid #eee;
        }
        .company-info {
            margin-bottom: 30px;
        }
        .invoice-details {
            display: flex;
            justify-content: space-between;
            margin-bottom: 30px;
        }
        .invoice-info, .client-info {
            width: 48%;
        }
        .invoice-info h3, .client-info h3 {
            margin-bottom: 10px;
            color: #555;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }
        th, td {
            border: 1px solid #ddd;
            padding: 12px;
            text-align: left;
        }
        th {
            background-color: #f8f9fa;
            font-weight: bold;
        }
        .total-section {
            margin-top: 20px;
            text-align: right;
        }
        .total-row {
            font-weight: bold;
            font-size: 1.2em;
            background-color: #f8f9fa;
        }
        .status {
            padding: 5px 10px;
            border-radius: 4px;
            color: white;
            font-weight: bold;
        }
        .status.paid { background-color: #28a745; }
        .status.pending { background-color: #ffc107; color: #333; }
        .status.overdue { background-color: #dc3545; }
    </style>
</head>
<body>
    <div class="header">
        <h1>INVOICE</h1>
        <h2>{{ $invoice->invoice_number }}</h2>
    </div>

    <div class="company-info">
        <h2>Your Company Name</h2>
        <p>Your Company Address<br>
        City, State ZIP<br>
        Phone: (123) 456-7890<br>
        Email: info@yourcompany.com</p>
    </div>

    <div class="invoice-details">
        <div class="invoice-info">
            <h3>Invoice Information</h3>
            <p><strong>Invoice Date:</strong> {{ $invoice->created_at->format('M d, Y') }}</p>
            <p><strong>Due Date:</strong> {{ $invoice->due_date ? $invoice->due_date->format('M d, Y') : 'N/A' }}</p>
            <p><strong>Status:</strong> 
                <span class="status {{ strtolower($invoice->status) }}">
                    {{ ucfirst($invoice->status) }}
                </span>
            </p>
        </div>

        <div class="client-info">
            <h3>Bill To</h3>
            <p><strong>{{ $invoice->client_name }}</strong><br>
            {{ $invoice->client_address ?? 'Address not available' }}<br>
            {{ $invoice->client_email ?? 'Email not available' }}</p>
        </div>
    </div>

    @if($invoice->items && $invoice->items->count() > 0)
    <table>
        <thead>
            <tr>
                <th>Description</th>
                <th>Quantity</th>
                <th>Rate</th>
                <th>Amount</th>
            </tr>
        </thead>
        <tbody>
            @foreach($invoice->items as $item)
            <tr>
                <td>{{ $item->description }}</td>
                <td>{{ $item->quantity }}</td>
                <td>${{ number_format($item->rate, 2) }}</td>
                <td>${{ number_format($item->quantity * $item->rate, 2) }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
    @endif

    <div class="total-section">
        <table style="width: 300px; margin-left: auto;">
            <tr>
                <td><strong>Subtotal:</strong></td>
                <td style="text-align: right;">${{ number_format($invoice->subtotal ?? $invoice->amount, 2) }}</td>
            </tr>
            @if($invoice->tax_amount)
            <tr>
                <td><strong>Tax:</strong></td>
                <td style="text-align: right;">${{ number_format($invoice->tax_amount, 2) }}</td>
            </tr>
            @endif
            <tr class="total-row">
                <td><strong>Total:</strong></td>
                <td style="text-align: right;"><strong>${{ number_format($invoice->amount, 2) }}</strong></td>
            </tr>
        </table>
    </div>

    <div style="margin-top: 50px; padding-top: 20px; border-top: 1px solid #eee;">
        <p><strong>Notes:</strong></p>
        <p>{{ $invoice->notes ?? 'Thank you for your business!' }}</p>
    </div>
</body>
</html>
