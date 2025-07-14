@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <h1>Invoices</h1>
                <div>
                    <!-- Download All Invoices Button -->
                    <a href="{{ route('invoices.download-all-pdf') }}" class="btn btn-success">
                        <i class="fas fa-download"></i> Download All PDFs
                    </a>
                    <!-- Add New Invoice Button -->
                    <a href="{{ route('invoices.create') }}" class="btn btn-primary ml-2">
                        <i class="fas fa-plus"></i> New Invoice
                    </a>
                </div>
            </div>

            <!-- Optional: Add filters for PDF download -->
            <div class="card mb-3">
                <div class="card-body">
                    <form method="GET" action="{{ route('invoices.download-all-pdf') }}" class="row g-3">
                        <div class="col-md-3">
                            <label class="form-label">Status Filter</label>
                            <select name="status" class="form-select">
                                <option value="">All Status</option>
                                <option value="paid">Paid</option>
                                <option value="pending">Pending</option>
                                <option value="overdue">Overdue</option>
                            </select>
                        </div>
                        <div class="col-md-3">
                            <label class="form-label">Date From</label>
                            <input type="date" name="date_from" class="form-control">
                        </div>
                        <div class="col-md-3">
                            <label class="form-label">Date To</label>
                            <input type="date" name="date_to" class="form-control">
                        </div>
                        <div class="col-md-3">
                            <label class="form-label">&nbsp;</label>
                            <button type="submit" class="btn btn-info d-block">
                                <i class="fas fa-filter"></i> Download Filtered PDF
                            </button>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Invoices Table -->
            <div class="card">
                <div class="card-body">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>Invoice #</th>
                                <th>Client</th>
                                <th>Date</th>
                                <th>Due Date</th>
                                <th>Amount</th>
                                <th>Status</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($invoices as $invoice)
                            <tr>
                                <td>{{ $invoice->invoice_number }}</td>
                                <td>{{ $invoice->client_name }}</td>
                                <td>{{ $invoice->created_at->format('M d, Y') }}</td>
                                <td>{{ $invoice->due_date ? $invoice->due_date->format('M d, Y') : 'N/A' }}</td>
                                <td>${{ number_format($invoice->amount, 2) }}</td>
                                <td>
                                    <span class="badge bg-{{ $invoice->status === 'paid' ? 'success' : ($invoice->status === 'pending' ? 'warning' : 'danger') }}">
                                        {{ ucfirst($invoice->status) }}
                                    </span>
                                </td>
                                <td>
                                    <!-- View Button -->
                                    <a href="{{ route('invoices.show', $invoice->id) }}" class="btn btn-sm btn-outline-primary">
                                        <i class="fas fa-eye"></i> View
                                    </a>
                                    
                                    <!-- Edit Button -->
                                    <a href="{{ route('invoices.edit', $invoice->id) }}" class="btn btn-sm btn-outline-secondary">
                                        <i class="fas fa-edit"></i> Edit
                                    </a>
                                    
                                    <!-- Download PDF Button -->
                                    <a href="{{ route('invoices.download-pdf', $invoice->id) }}" class="btn btn-sm btn-outline-success" title="Download PDF">
                                        <i class="fas fa-file-pdf"></i> PDF
                                    </a>
                                    
                                    <!-- Delete Button -->
                                    <form method="POST" action="{{ route('invoices.destroy', $invoice->id) }}" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-outline-danger" onclick="return confirm('Are you sure?')">
                                            <i class="fas fa-trash"></i> Delete
                                        </button>
                                    </form>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="7" class="text-center">No invoices found.</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                    
                    <!-- Pagination if needed -->
                    @if($invoices instanceof \Illuminate\Pagination\LengthAwarePaginator)
                        {{ $invoices->links() }}
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
