@extends('pdfs.layouts.master')


@section('content')

<style>
    body {
        margin: 0;
        padding: 0;      
    }
    
    .content-wrapper {
        padding: 20px;
        margin-top: 0;
    }
    
</style>


<div class="content-wrapper">
    <!-- Vehicle Header -->
    @include('pdfs.sections.vehicle-basic-info', ['vehicle' => $vehicle])

    <!-- Price Section -->
    @include('pdfs.sections.vehicle-price-info', ['vehicle' => $vehicle])

    <!-- Main Vehicle Image -->
    @include('pdfs.sections.vehicle-images', ['vehicle' => $vehicle])

    <!-- Vehicle Characteristics -->
    @include('pdfs.sections.vehicle-characteristics', ['vehicle' => $vehicle])

    <!-- Technical Specifications -->
    

    <!-- Additional Information -->
    @if(!empty($vehicle['description2']))
        <div class="characteristics-section">
            <h2 class="section-title">Otros datos relevantes</h2>
            <div class="description-content">
                {!! nl2br(e($vehicle['description2'])) !!}
            </div>
        </div>
    @endif

    <!-- Vehicle Description -->
    @if(!empty($vehicle['description']))
        <div class="description-section">
            <h2 class="section-title">Descripción del vehículo</h2>
            <div class="description-content">
                {!! $vehicle['description'] !!}
            </div>
        </div>
    @endif

    <!-- Page Break for Images -->
    <div class="page-break"></div>

    <!-- Images Gallery -->
    @include('pdfs.sections.vehicle-images-gallary', ['vehicle' => $vehicle])

    <!-- Financial Information Details -->
    @include('pdfs.sections.vehicle-financial-info', ['vehicle' => $vehicle])




    </div> <!-- End of content-wrapper -->
@endsection