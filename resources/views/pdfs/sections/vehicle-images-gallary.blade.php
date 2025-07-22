@if(!empty($vehicle['images']) && count($vehicle['images']) > 0)
    <div class="image-gallery">
        <h2 class="gallery-title">Algunas fotos del vehículo</h2>

        <div class="image-grid">
            @foreach($vehicle['images'] as $index => $image)
                @if($index < 6)   {{-- first 6 only --}}
                    <img  src="{{ $image }}"
                          alt="Imagen vehículo {{ $index + 1 }}"
                          class="gallery-image">
                @endif
            @endforeach
        </div>
    </div>

    <style>
        /* ───────── wrapper ───────── */
        .image-gallery{
            width:100%;
            margin:0 0 15px;
            box-sizing:border-box;
            break-inside:avoid;
            page-break-inside:avoid;
        }

        /* center the title */
        .gallery-title{
            text-align:center;
            font:700 20px/1.3 'Montserrat',sans-serif;
            margin:0 0 12px;
        }

        /* ───────── 3 × 2 grid ───────── */
        .image-grid{
            display:grid;
            grid-template-columns:repeat(3,1fr);  /* 3 per row  */
            gap:8px;                               /* gutters ≈2.1 mm */
            break-inside:avoid;
            page-break-inside:avoid;
        }

        /* ───────── individual image ───────── */
        .gallery-image{
            width:100%;
            height:85mm;            /* fills page height better */
            object-fit:cover;
            border-radius:15px;
            box-shadow:0 2px 6px rgba(0,0,0,.15);
            -webkit-print-color-adjust:exact;
                    print-color-adjust:exact;
        }
    </style>
@endif
