<?php

namespace App\Support;

use Spatie\LaravelPdf\Facades\Pdf;
use Spatie\LaravelPdf\PdfBuilder;

class PdfHelper
{
    /**
     * Generate a PDF from HTML content with sandbox disabled for Docker environments
     *
     * @param string $html The HTML content
     * @param string|null $filename Optional filename for the PDF
     * @return PdfBuilder
     */
    public static function fromHtml(string $html, ?string $filename = null): PdfBuilder
    {
        $pdf = Pdf::html($html);
        
        // Apply browsershot configuration including disabling sandbox
        return $pdf->withBrowsershot(function ($browsershot) {
            $browsershot->noSandbox();
        })->format(config('pdf.default_paper_size'))
          ->name($filename);
    }

    /**
     * Generate a PDF from a view with sandbox disabled for Docker environments
     *
     * @param string $view The view name
     * @param array $data The data to pass to the view
     * @param string|null $filename Optional filename for the PDF
     * @return PdfBuilder
     */
    public static function fromView(string $view, array $data = [], ?string $filename = null): PdfBuilder
    {
        $pdf = Pdf::view($view, $data);
        
        // Apply browsershot configuration including disabling sandbox
        return $pdf->withBrowsershot(function ($browsershot) {
            $browsershot->noSandbox();
        })->format(config('pdf.default_paper_size'))
          ->name($filename);
    }
}
