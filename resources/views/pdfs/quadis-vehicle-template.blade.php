@extends('pdfs.layouts.master')

@section('content')

{{-- INLINE CSS (you can move it to resources/css/pdf.css if you prefer) --}}
<style>
@page { 
    
    size:A4 portrait;
    margin:40px 15px 85px 15px;   70 + 20  /  80 + 5 


    /* Footer Full Width Styles */
    .footer-wrapper,
    .legal-section,
    .black-footer {
        width: 100% !important;
        margin-left: -50px !important;    /* Compensate for page left padding */
        margin-right: -50px !important;   /* Compensate for page right padding */
        padding-left: 50px !important;    /* Restore content padding */
        padding-right: 50px !important;   /* Restore content padding */
        box-sizing: border-box;
    }


 }   /* pdf has its own margins inside .page */

 body{margin:0;padding:0}

.pdf-header {
    /* Fix width issues */
    width: 100% !important;
    max-width: 100% !important;
    min-width: 100%;
    
    /* Fix margin/spacing issues */
    margin: 0 !important;
    padding: 15px 0 15px 0; /* Only bottom padding for spacing */
    
    /* Layout properties */
    display: block;
    box-sizing: border-box;
    position: relative;
    left: 0;
    right: 0;
    top: 0;
    
    /* Visual styling */
    border-bottom: 3px solid #f5a100;
    background: transparent;
}

.page{
    /* one HTML wrapper = one printed sheet  --------------------------- */
    display:block;            /* HAS to be block for the rule to work   */
    width:100%;
    break-after: page;        /* modern paged-media syntax              */
    page-break-after: always; /* legacy syntax (Chrome fallback)        */
    padding: 40px 50px 60px;  /* inner margins of every sheet           */
}
.page:last-of-type{
    break-after: auto;
    page-break-after: auto;
}

/* Make absolutely sure sheet-2/3 start on a new page as well ---------- */
.second-page,
.third-page{
    break-before: page;
    page-break-before: always;
}

/* FIRST PAGE sizes so "Características" still fits -------------------- */
.first-page .basic-info { 
    max-height: 300px; 
    margin-bottom: 20px;
    width: 100%;                    /* Use full available width */
    max-width: none;                /* Remove any width restrictions */
}

.first-page .characteristics { 
    max-height: 270px; 
}
/* Basic info without yellow border */
.basic-info {
    border-radius: 22px;
    padding: 22px 26px;
    break-inside: avoid;
    page-break-inside: avoid;
    margin-bottom: 45px;
    font-size: 11px;
    width: 100%;                    /* Full width */
    box-sizing: border-box;         /* Include padding in width calculation */
}

/* CHARACTERISTICS SECTION  */
.characteristics {
    border-radius: 22px;
    padding: 22px 26px;
    break-inside: avoid;
    page-break-inside: avoid;
    margin-bottom: 25px;
    margin-top: 20px; /* Add margin to separate from basic-info */
    font-size: 11px;
    width: 100%;
    box-sizing: border-box;
    position: relative;               /* Prevent overlap */
    z-index: 2;                      /* Ensure it renders above basic-info */
    clear: both;                     /* Clear any floats */
    margin-top: 10px;                /* Small gap from basic-info */
}

/* Generic white rounded boxes ---------------------------------------- */

.characteristics-section,
.description-section,
.technical-details{
    border:2px solid #FFD36D;
    border-radius:22px;
    padding:22px 26px;
    break-inside: avoid;
    page-break-inside: avoid;
    margin-bottom:25px;
    font-size:11px;
}

/* Titles on second sheet --------------------------------------------- */
.second-page .section-title{
    font:700 18px/1.2 'Montserrat', sans-serif;
    margin:0 0 12px;
}

/* Optional image grid (sheet-3) -------------------------------------- */
.third-page .image-grid{
    display:grid;
    grid-template-columns:repeat(3,1fr);
    gap:12px;
}


</style>


<div class="page first-page">

    {{-- header / logo / banner (if you have one) ----------------------- --}}
    @includeWhen(
        View::exists('pdfs.partials.header'),
        'pdfs.partials.header',
        ['vehicle' => $vehicle]
    )

    {{-- Basic information --------------------------------------------- --}}
    <div class="basic-info">
        @include('pdfs.sections.vehicle-basic-info', ['vehicle' => $vehicle])
    </div>

    {{-- “Características” --------------------------------------------- --}}
  
    <div class="characteristics">
        @include('pdfs.sections.vehicle-characteristics', ['vehicle' => $vehicle])
    </div>

    {{-- Optional legal strip at bottom of page-1 ----------------------- --}}
    @includeWhen(
        View::exists('pdfs.sections.vehicle-legal-strip'),
        'pdfs.sections.vehicle-legal-strip',
        ['vehicle' => $vehicle]
    )
</div>

<div class="page second-page">

    @include('pdfs.sections.vehicle-technical-details', ['vehicle' => $vehicle])

    @if(!empty($vehicle['description2']))
        <div class="characteristics-section">
            <h2 class="section-title">Otros datos relevantes</h2>
            <div class="description-content">
                {!! nl2br(e($vehicle['description2'])) !!}
            </div>
        </div>
    @endif

    @if(!empty($vehicle['description']))
        <div class="description-section">
            <h2 class="section-title">Descripción del vehículo</h2>
            <div class="description-content">
                {!! $vehicle['description'] !!}
            </div>
        </div>
    @endif

      
    {{-- Include black footer on page 2 --}}
    @include('pdfs.partials.footer', ['showBlackFooter' => true]) 

</div>


<div class="page third-page">

    @include('pdfs.sections.vehicle-images-gallary', ['vehicle' => $vehicle])

    @include('pdfs.sections.vehicle-financial-info', ['vehicle' => $vehicle])

    {{-- Include black footer on page 3 --}}
    @include('pdfs.partials.footer', ['showBlackFooter' => true])
</div>

@endsection
