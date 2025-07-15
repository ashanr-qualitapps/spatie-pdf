<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Support\PdfHelper;
use Spatie\LaravelPdf\Facades\Pdf;

class PdfController extends Controller
{
    /**
     * Generate a PDF based on the provided ID.
     *
     * @param string $id
     * @return \Illuminate\Http\Response
     */
    public function generatePdf($id)
    {
        // Create a simple PDF with the ID included
        $html = "<h1>Generated PDF</h1><p>ID: {$id}</p>";
        
        // Use the PdfHelper to ensure sandbox is disabled in Docker
        return Pdf::html($html)
            ->withBrowsershot(function ($browsershot) {
                $browsershot->noSandbox();
            })
            ->name("document-{$id}.pdf")
            ->download();
    }
}
                'error' => 'PDF generation failed',
                'message' => $e->getMessage()
            ], 500);
        }
    }
}
