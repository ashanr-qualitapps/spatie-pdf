<?php
namespace App\Helpers;

class PdfAsset
{
    /**
     * Return a data-URI string for any file in /public.
     */
    public static function base64(string $relativePath): string
    {
        $absolute = public_path($relativePath);

        // Fallback text if the file is missing
        if (! is_file($absolute)) {
            return '';
        }

        $mime  = mime_content_type($absolute);   // e.g. image/png  |  image/svg+xml
        $data  = base64_encode(file_get_contents($absolute));

        return "data:{$mime};base64,{$data}";
    }
}
