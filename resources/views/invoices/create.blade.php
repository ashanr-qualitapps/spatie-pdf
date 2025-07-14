@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h1>Create New Invoice</h1>
    
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    
    <form action="{{ route('invoices.store') }}" method="POST">
        @csrf
        
        <div class="mb-3">
            <label for="content_html" class="form-label">Custom HTML Content (optional)</label>
            <textarea class="form-control" id="content_html" name="content_html" rows="10">{{ old('content_html') }}</textarea>
            <small class="text-muted">You can add custom HTML content for your invoice here.</small>
        </div>
        
        <!-- Add more fields as needed for your Invoice model -->
        
        <div class="mb-3">
            <button type="submit" class="btn btn-primary">Create Invoice</button>
            <a href="{{ route('invoices.index') }}" class="btn btn-link">Cancel</a>
        </div>
    </form>
</div>
@endsection
