<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Invoices</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-4">
        <h1>Invoices</h1>
        
        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif
        
        <a href="{{ route('invoices.create') }}" class="btn btn-primary mb-3">Create New Invoice</a>
        
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Created At</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($invoices as $invoice)
                <tr>
                    <td>{{ $invoice->id }}</td>
                    <td>{{ $invoice->created_at }}</td>
                    <td>
                        <a href="{{ route('invoices.show', $invoice) }}" class="btn btn-info btn-sm">View</a>
                        <a href="{{ route('invoices.edit', $invoice) }}" class="btn btn-warning btn-sm">Edit</a>
                        <a href="{{ route('invoices.view-pdf', $invoice) }}" class="btn btn-primary btn-sm" target="_blank">View PDF</a>
                        <a href="{{ route('invoices.download-pdf', $invoice) }}" class="btn btn-secondary btn-sm">Download PDF</a>
                        <form action="{{ route('invoices.destroy', $invoice) }}" method="POST" style="display:inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure?')">Delete</button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="3">No invoices found.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</body>
</html>
