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
        $invoices = Invoice::latest()->paginate(10);
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
            'title' => 'required|string|max:255',
            'content' => 'required',
            'client_name' => 'required|string|max:255',
            'client_email' => 'nullable|email|max:255',
            'invoice_number' => 'required|string|unique:invoices,invoice_number',
            'issue_date' => 'required|date',
            'due_date' => 'required|date|after_or_equal:issue_date',
            'total_amount' => 'required|numeric|min:0',
            'status' => 'required|string|in:draft,sent,paid,overdue',
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
            'title' => 'required|string|max:255',
            'content' => 'required',
            'client_name' => 'required|string|max:255',
            'client_email' => 'nullable|email|max:255',
            'invoice_number' => 'required|string|unique:invoices,invoice_number,' . $invoice->id,
            'issue_date' => 'required|date',
            'due_date' => 'required|date|after_or_equal:issue_date',
            'total_amount' => 'required|numeric|min:0',
            'status' => 'required|string|in:draft,sent,paid,overdue',
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


    
    /**
     * Generate and download all invoices as PDF report
     */
    public function downloadAllPdf(Request $request)
    {
        $query = Invoice::query();
        
        // Apply any filters if needed
        if ($request->status) {
            $query->where('status', $request->status);
        }
        
        if ($request->date_from) {
            $query->whereDate('created_at', '>=', $request->date_from);
        }
        
        if ($request->date_to) {
            $query->whereDate('created_at', '<=', $request->date_to);
        }
        
        $invoices = $query->get();
        
        return Pdf::view('invoices.all-pdf', compact('invoices'))
            ->format('a4')
            ->orientation('landscape')
            ->name('invoices-report-' . date('Y-m-d') . '.pdf')
            ->download();
    }
}
