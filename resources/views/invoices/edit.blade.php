<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit Invoice') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <form method="POST" action="{{ route('invoices.update', $invoice) }}">
                        @csrf
                        @method('PUT')
                        
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <x-label for="title" :value="__('Title')" />
                                <x-input id="title" class="block mt-1 w-full" type="text" name="title" :value="old('title', $invoice->title)" required autofocus />
                            </div>

                            <div>
                                <x-label for="invoice_number" :value="__('Invoice Number')" />
                                <x-input id="invoice_number" class="block mt-1 w-full" type="text" name="invoice_number" :value="old('invoice_number', $invoice->invoice_number)" required />
                            </div>

                            <div>
                                <x-label for="client_name" :value="__('Client Name')" />
                                <x-input id="client_name" class="block mt-1 w-full" type="text" name="client_name" :value="old('client_name', $invoice->client_name)" required />
                            </div>

                            <div>
                                <x-label for="client_email" :value="__('Client Email')" />
                                <x-input id="client_email" class="block mt-1 w-full" type="email" name="client_email" :value="old('client_email', $invoice->client_email)" />
                            </div>

                            <div>
                                <x-label for="issue_date" :value="__('Issue Date')" />
                                <x-input id="issue_date" class="block mt-1 w-full" type="date" name="issue_date" :value="old('issue_date', $invoice->issue_date->format('Y-m-d'))" required />
                            </div>

                            <div>
                                <x-label for="due_date" :value="__('Due Date')" />
                                <x-input id="due_date" class="block mt-1 w-full" type="date" name="due_date" :value="old('due_date', $invoice->due_date->format('Y-m-d'))" required />
                            </div>

                            <div>
                                <x-label for="total_amount" :value="__('Total Amount')" />
                                <x-input id="total_amount" class="block mt-1 w-full" type="number" step="0.01" name="total_amount" :value="old('total_amount', $invoice->total_amount)" required />
                            </div>

                            <div>
                                <x-label for="status" :value="__('Status')" />
                                <select id="status" name="status" class="rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 block mt-1 w-full">
                                    <option value="draft" {{ old('status', $invoice->status) == 'draft' ? 'selected' : '' }}>Draft</option>
                                    <option value="sent" {{ old('status', $invoice->status) == 'sent' ? 'selected' : '' }}>Sent</option>
                                    <option value="paid" {{ old('status', $invoice->status) == 'paid' ? 'selected' : '' }}>Paid</option>
                                    <option value="overdue" {{ old('status', $invoice->status) == 'overdue' ? 'selected' : '' }}>Overdue</option>
                                </select>
                            </div>
                        </div>

                        <div class="mt-6">
                            <x-label for="content" :value="__('Invoice Content')" />
                            <textarea id="content" name="content" class="ckeditor">{{ old('content', $invoice->content) }}</textarea>
                        </div>

                        <div class="flex items-center justify-end mt-4">
                            <x-button class="ml-3">
                                {{ __('Update Invoice') }}
                            </x-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    @push('scripts')
    <script src="https://cdn.ckeditor.com/4.16.2/standard-all/ckeditor.js"></script>
    <script>
        CKEDITOR.replace('content', {
            height: 400,
            removeButtons: '',
            toolbarGroups: [
                { name: 'document', groups: [ 'mode', 'document', 'doctools' ] },
                { name: 'clipboard', groups: [ 'clipboard', 'undo' ] },
                { name: 'editing', groups: [ 'find', 'selection', 'spellchecker', 'editing' ] },
                { name: 'forms', groups: [ 'forms' ] },
                { name: 'basicstyles', groups: [ 'basicstyles', 'cleanup' ] },
                { name: 'paragraph', groups: [ 'list', 'indent', 'blocks', 'align', 'bidi', 'paragraph' ] },
                { name: 'links', groups: [ 'links' ] },
                { name: 'insert', groups: [ 'insert' ] },
                { name: 'styles', groups: [ 'styles' ] },
                { name: 'colors', groups: [ 'colors' ] },
                { name: 'tools', groups: [ 'tools' ] },
                { name: 'others', groups: [ 'others' ] },
                { name: 'about', groups: [ 'about' ] }
            ],
            extraPlugins: 'tableresize,tabletools,table,div,justify,font,colorbutton,colordialog',
            contentsCss: [
                'https://cdn.ckeditor.com/4.16.2/full-all/contents.css',
                'https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css'
            ],
            bodyClass: 'document-editor',
            format_tags: 'p;h1;h2;h3;pre',
            removeDialogTabs: 'image:advanced;link:advanced',
            allowedContent: true,
        });
    </script>
    @endpush
</x-app-layout>
