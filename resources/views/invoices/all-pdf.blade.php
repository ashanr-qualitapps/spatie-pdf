<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Invoices Report</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
            font-size: 12px;
        }
        .header {
            text-align: center;
            margin-bottom: 30px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }
        th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
            font-weight: bold;
        }
        .total-row {
            font-weight: bold;
            background-color: #f9f9f9;
        }
        .status {
            padding: 2px 6px;
            border-radius: 3px;
            font-size: 10px;
            color: white;
        }
        .status.paid { background-color: #28a745; }
        .status.pending { background-color: #ffc107; color: #333; }
        .status.overdue { background-color: #dc3545; }
    </style>
</head>
<body>
    <div class="header">
        <h1>Invoices Report</h1>
        <p>Generated on: {{ date('M d, Y H:i:s') }}</p>
        <p>Total Invoices: {{ $invoices->count() }}</p>
    </div>

    <table>
        <thead>
            <tr>
                <th>Invoice #</th>
                <th>Client</th>
                <th>Date</th>
                <th>Due Date</th>
                <th>Amount</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            @foreach($invoices as $invoice)
            <tr>
                <td>{{ $invoice->invoice_number }}</td>
                <td>{{ $invoice->client_name }}</td>
                <td>{{ $invoice->created_at->format('M d, Y') }}</td>
                <td>{{ $invoice->due_date ? $invoice->due_date->format('M d, Y') : 'N/A' }}</td>
                <td>${{ number_format($invoice->amount, 2) }}</td>
                <td>
                    <span class="status {{ strtolower($invoice->status) }}">
                        {{ ucfirst($invoice->status) }}
                    </span>
                </td>
            </tr>
            @endforeach
        </tbody>
        <tfoot>
            <tr class="total-row">
                <td colspan="4">Total Amount</td>
                <td>${{ number_format($invoices->sum('amount'), 2) }}</td>
                <td>{{ $invoices->count() }} invoices</td>
            </tr>
        </tfoot>
    </table>
</body>
</html>
