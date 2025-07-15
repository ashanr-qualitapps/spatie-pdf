<?php

namespace App\Http\Controllers;

use App\Models\Invoice;
use App\Support\PdfHelper;
use Illuminate\Http\Request;

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
        return PdfHelper::fromView('pdfs.invoice', ['invoice' => $invoice])
            ->name("invoice-{$invoice->invoice_number}.pdf")
            ->download();
    }

    /**
     * View PDF for an invoice in the browser
     */
    public function viewPdf(Invoice $invoice)
    {
        return PdfHelper::fromView('pdfs.invoice', ['invoice' => $invoice])
            ->name("invoice-{$invoice->invoice_number}.pdf")
            ->inline();
    }

    /**
     * Generate and download all invoices as PDF report
     */
    public function downloadAllPdf(Request $request)
    {
        $invoices = Invoice::query();
        
        // Apply filters if provided
        if ($request->has('status')) {
            $invoices->where('status', $request->status);
        }
        
        if ($request->has('date_from')) {
            $invoices->whereDate('issue_date', '>=', $request->date_from);
        }
        
        if ($request->has('date_to')) {
            $invoices->whereDate('issue_date', '<=', $request->date_to);
        }
        
        $invoices = $invoices->get();
        
        return PdfHelper::fromView('pdfs.all-invoices', ['invoices' => $invoices])
            ->name('all-invoices.pdf')
            ->download();
    }
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
