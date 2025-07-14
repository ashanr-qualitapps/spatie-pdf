@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h1>Invoice #{{ $invoice->id }}</h1>
    <p><strong>Date:</strong> {{ $invoice->created_at->format('F j, Y') }}</p>
    <div class="mb-3">
        <strong>HTML Content:</strong>
        <div class="border p-3">
            {!! $invoice->content_html ?? '<em>No custom HTML content for this invoice.</em>' !!}
        </div>
    </div>
    <a href="{{ route('invoices.view-pdf', $invoice) }}" class="btn btn-primary" target="_blank">View PDF</a>
    <a href="{{ route('invoices.download-pdf', $invoice) }}" class="btn btn-secondary">Download PDF</a>
    <a href="{{ route('invoices.index') }}" class="btn btn-link">Back to Invoices</a>
</div>
@endsection
