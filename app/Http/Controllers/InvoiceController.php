<?php

namespace App\Http\Controllers;

use App\Models\Invoice;
use Illuminate\Http\Request;
use Spatie\LaravelPdf\Facades\Pdf;

class InvoiceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $invoices = Invoice::all();
        return view('invoices.index', compact('invoices'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('invoices.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'content_html' => 'nullable',
            // Add other validation rules as needed
        ]);

        Invoice::create($validated);
        return redirect()->route('invoices.index')->with('success', 'Invoice created successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(Invoice $invoice)
    {
        return view('invoices.show', compact('invoice'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Invoice $invoice)
    {
        return view('invoices.edit', compact('invoice'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Invoice $invoice)
    {
        $validated = $request->validate([
            'content_html' => 'nullable',
            // Add other validation rules as needed
        ]);

        $invoice->update($validated);
        return redirect()->route('invoices.index')->with('success', 'Invoice updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Invoice $invoice)
    {
        $invoice->delete();
        return redirect()->route('invoices.index')->with('success', 'Invoice deleted successfully');
    }

    /**
     * Generate and download PDF for an invoice
     */
    public function downloadPdf(Invoice $invoice)
    {
        if ($invoice->content_html) {
            return Pdf::html($invoice->content_html)
                ->format('a4')
                ->download('invoice-' . $invoice->id . '.pdf');
        }
        
        // Use the PDF view template
        return Pdf::view('invoices.pdf', ['invoice' => $invoice])
            ->format('a4')
            ->download('invoice-' . $invoice->id . '.pdf');
    }

    /**
     * View PDF for an invoice in the browser
     */
    public function viewPdf(Invoice $invoice)
    {
        if ($invoice->content_html) {
            return Pdf::html($invoice->content_html)
                ->format('a4')
                ->stream('invoice-' . $invoice->id . '.pdf');
        }
        
        // Use the PDF view template
        return Pdf::view('invoices.pdf', ['invoice' => $invoice])
            ->format('a4')
            ->stream('invoice-' . $invoice->id . '.pdf');
    }
}
