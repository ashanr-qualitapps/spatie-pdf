<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Invoice Details') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <div class="mb-6 flex justify-between items-center">
                        <h1 class="text-2xl font-bold">Invoice #{{ $invoice->invoice_number }}</h1>
                        <div class="space-x-2">
                            <a href="{{ route('invoices.view-pdf', $invoice) }}" class="inline-flex items-center px-4 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-700" target="_blank">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                </svg>
                                View PDF
                            </a>
                            <a href="{{ route('invoices.download-pdf', $invoice) }}" class="inline-flex items-center px-4 py-2 bg-gray-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4" />
                                </svg>
                                Download PDF
                            </a>
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                        <div>
                            <p><strong>Client:</strong> {{ $invoice->client_name }}</p>
                            <p><strong>Email:</strong> {{ $invoice->client_email ?? 'N/A' }}</p>
                            <p><strong>Status:</strong> 
                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full 
                                    {{ $invoice->status === 'draft' ? 'bg-gray-100 text-gray-800' : '' }}
                                    {{ $invoice->status === 'sent' ? 'bg-blue-100 text-blue-800' : '' }}
                                    {{ $invoice->status === 'paid' ? 'bg-green-100 text-green-800' : '' }}
                                    {{ $invoice->status === 'overdue' ? 'bg-red-100 text-red-800' : '' }}">
                                    {{ ucfirst($invoice->status) }}
                                </span>
                            </p>
                        </div>
                        <div>
                            <p><strong>Issue Date:</strong> {{ $invoice->issue_date->format('F j, Y') }}</p>
                            <p><strong>Due Date:</strong> {{ $invoice->due_date->format('F j, Y') }}</p>
                            <p><strong>Total Amount:</strong> ${{ number_format($invoice->total_amount, 2) }}</p>
                        </div>
                    </div>

                    <div class="mb-6">
                        <h3 class="text-lg font-medium mb-2">Invoice Content:</h3>
                        <div class="border p-4 bg-gray-50 rounded">
                            {!! $invoice->content ?? '<em>No custom content for this invoice.</em>' !!}
                        </div>
                    </div>

                    <div class="flex justify-between">
                        <a href="{{ route('invoices.index') }}" class="inline-flex items-center px-4 py-2 bg-gray-200 border border-transparent rounded-md font-semibold text-xs text-gray-700 uppercase tracking-widest hover:bg-gray-300">
                            Back to Invoices
                        </a>
                        <a href="{{ route('invoices.edit', $invoice) }}" class="inline-flex items-center px-4 py-2 bg-yellow-500 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-yellow-600">
                            Edit Invoice
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
