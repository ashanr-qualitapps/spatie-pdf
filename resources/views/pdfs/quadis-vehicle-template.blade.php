@extends('pdfs.layouts.master')
@section('styles')
<style>
@page { 
    size:A4 portrait;
    margin: 20mm 15mm 20mm 15mm;   /* T / R / B / L */
    /* Footer Full Width Styles */


 }   /* pdf has its own margins inside .page */


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

 /* first sheet */
@page:first{
    margin: 30mm 0 20mm 0;           /* 30 mm header, 0 side margins */
    @top-center{
        content: element(firstHeader);    /* place the running header here */
    }
}

 body{margin:0;padding:0}


.page{
    /* one HTML wrapper = one printed sheet  --------------------------- */
    display:block;            /* HAS to be block for the rule to work   */
    width:100%;
    break-after: page;        /* modern paged-media syntax              */
    page-break-after: always; /* legacy syntax (Chrome fallback)        */
    padding:0;             /* no inner space, we use margins instead */
}

.sheet-body{ padding:40px 50px 60px;}

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

/* goes in the <head> of the template, before any page is laid out */
.first-page-header{
    position: running(firstHeader);   /* lift into page margin           */
    height: 30mm;                     /* ≈10 % of A4 height              */
    width: 100%;

    /* ABSOLUTELY NO OUTER SPACE */
    margin: 0;                        /* ← kill margins                  */
    padding: 0;                       /* ← kill padding on all sides     */

    background:#000;
    color:#fff;
    display:flex;
    align-items:center;
    justify-content:space-between;

    -webkit-print-color-adjust:exact;
            print-color-adjust:exact;
}


</style>
@endsection


@section('content')
  
        <div class="first-page-header">
            <img src="{{ $header_logo }}" alt="Logo" style="height:22mm">
            <div style="font:700 16px/1.2 'Montserrat',sans-serif">
                ¿Tienes dudas?<br>¡Llámanos al 900 100 102!
            </div>
        </div>

<div class="page first-page">

    {{-- Header with logo and contact info ------------------------------- --}}
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
    
   

</div>


<div class="page third-page">

    @include('pdfs.sections.vehicle-images-gallary', ['vehicle' => $vehicle])

    @include('pdfs.sections.vehicle-financial-info', ['vehicle' => $vehicle])

</div>

@endsection
