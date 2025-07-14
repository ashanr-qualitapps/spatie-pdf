<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Invoices</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <x-app-layout>
        <x-slot name="header">
            <div class="flex justify-between">
                <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                    {{ __('Invoices') }}
                </h2>
                <a href="{{ route('invoices.create') }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                    {{ __('Create New') }}
                </a>
            </div>
        </x-slot>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 bg-white border-b border-gray-200">
                        @if (session('success'))
                            <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-4" role="alert">
                                {{ session('success') }}
                            </div>
                        @endif

                        <div class="overflow-x-auto">
                            <table class="min-w-full divide-y divide-gray-200">
                                <thead>
                                    <tr>
                                        <th class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Invoice #
                                        </th>
                                        <th class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Title
                                        </th>
                                        <th class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Client
                                        </th>
                                        <th class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Issue Date
                                        </th>
                                        <th class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Due Date
                                        </th>
                                        <th class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Amount
                                        </th>
                                        <th class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Status
                                        </th>
                                        <th class="px-6 py-3 bg-gray-50 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Actions
                                        </th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white divide-y divide-gray-200">
                                    @forelse ($invoices as $invoice)
                                        <tr>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                                {{ $invoice->invoice_number }}
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                                {{ $invoice->title }}
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                                {{ $invoice->client_name }}
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                                {{ $invoice->issue_date->format('Y-m-d') }}
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                                {{ $invoice->due_date->format('Y-m-d') }}
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                                {{ number_format($invoice->total_amount, 2) }}
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full 
                                                    {{ $invoice->status === 'draft' ? 'bg-gray-100 text-gray-800' : '' }}
                                                    {{ $invoice->status === 'sent' ? 'bg-blue-100 text-blue-800' : '' }}
                                                    {{ $invoice->status === 'paid' ? 'bg-green-100 text-green-800' : '' }}
                                                    {{ $invoice->status === 'overdue' ? 'bg-red-100 text-red-800' : '' }}">
                                                    {{ ucfirst($invoice->status) }}
                                                </span>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                                <a href="{{ route('invoices.edit', $invoice) }}" class="text-indigo-600 hover:text-indigo-900 mr-3">Edit</a>
                                                <form class="inline-block" method="POST" action="{{ route('invoices.destroy', $invoice) }}" onsubmit="return confirm('Are you sure?');">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="text-red-600 hover:text-red-900">Delete</button>
                                                </form>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="8" class="px-6 py-4 whitespace-nowrap text-sm text-center text-gray-500">
                                                No invoices found.
                                            </td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                        
                        <div class="mt-4">
                            {{ $invoices->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </x-app-layout>
</body>
</html>
