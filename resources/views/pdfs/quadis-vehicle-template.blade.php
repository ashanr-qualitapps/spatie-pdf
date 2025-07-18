@extends('pdfs.layouts.master')


@section('content')

<style>
    .content-wrapper {
        padding-top: 70px; /* Add padding to prevent overlap with header */
    }
    
    /* Add top padding after page breaks */
    .page-break + * {
        padding-top: 70px;
    }
</style>

<div class="content-wrapper">
    <div class="main-content">
        <!-- Vehicle Header -->
        @include('pdfs.sections.vehicle-basic-info', ['vehicle' => $vehicle])

        <!-- Vehicle Characteristics -->
        @include('pdfs.sections.vehicle-characteristics', ['vehicle' => $vehicle])

        <!-- Technical Specifications -->
        @include('pdfs.sections.vehicle-technical-details', ['vehicle' => $vehicle])

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
    </div>

</div> <!-- End of content-wrapper -->
@endsection