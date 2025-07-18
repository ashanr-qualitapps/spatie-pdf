@extends('pdfs.layouts.master')

<!-- @section('title', 'QUADIS.es - ' . ($vehicle['make'] ?? '') . ' ' . ($vehicle['model'] ?? '')) -->

@section('content')

<style>
    body {
        margin: 0;
        padding: 0;
        padding-top: 60px; /* Add space for fixed header */
    }
    
    .content-wrapper {
        padding: 20px;
        margin-top: 0;
    }
    
    /* Your existing styles... */
</style>


<div class="content-wrapper">
    <!-- Vehicle Header -->
    <div class="vehicle-header">
        <div style="display: flex; justify-content: space-between; align-items: flex-start; margin-bottom: 15px;">
            <div style="flex: 1;">
                @if(!empty($vehicle['imageUrl']))
                    <img src="{{ $vehicle['imageUrl'] }}" alt="Vehicle" style="width: 80px; height: 60px; object-fit: cover; border-radius: 4px; border: 1px solid rgba(255,255,255,0.3);">
                @endif
            </div>
            <div style="flex: 2; text-align: center;">
                <div class="vehicle-title">{{ $vehicle['make'] ?? '' }} {{ $vehicle['model'] ?? '' }}</div>
                <div class="vehicle-version">{{ $vehicle['version'] ?? '' }}</div>
            </div>
            <div style="flex: 1; text-align: right;">
                <div class="ref-number">{{ $vehicle['vsbWip'] ?? '' }}</div>
            </div>
        </div>

        <div class="vehicle-meta">
            <div class="fuel-type">{{ $vehicle['fuel'] ?? '' }}</div>
            @if(!empty($vehicle['environmentalLabel']))
                <div class="env-label label-{{ strtolower($vehicle['environmentalLabel']) }}">
                    Distintivo Etiqueta {{ strtoupper($vehicle['environmentalLabel']) }}
                </div>
            @endif
            @if(!empty($vehicle['warranty']))
                <div class="warranty">{{ $vehicle['warranty'] }} MESES DE GARANTÍA</div>
            @endif
        </div>
    </div>

    <!-- Price Section -->
    <div class="price-section">
        <div class="price-grid">
            @if(!empty($vehicle['financedPrice']))
                <div class="price-item">
                    <div class="price-label">Precio financiado:</div>
                    <div class="price-value financed">{{ number_format($vehicle['financedPrice'], 0, ',', '.') }}€</div>
                </div>
            @endif

            @if(!empty($vehicle['price']))
                <div class="price-item">
                    <div class="price-label">Precio al contado:</div>
                    <div class="price-value">{{ number_format($vehicle['price'], 0, ',', '.') }}€</div>
                </div>
            @endif

            @if(!empty($vehicle['financialInformation']['monthlyPayment']))
                <div class="price-item">
                    <div class="price-label">Cuota mensual:</div>
                    <div class="price-value monthly">{{ $vehicle['financialInformation']['monthlyPayment'] }}€</div>
                </div>
            @endif
        </div>
    </div>

    <!-- Main Vehicle Image -->
    @if(!empty($vehicle['imageUrl']))
        <div class="image-section">
            <img src="{{ $vehicle['imageUrl'] }}" alt="Vehicle Image" class="main-image">
        </div>
    @elseif(!empty($vehicle['images']) && count($vehicle['images']) > 0)
        <div class="image-section">
            <img src="{{ $vehicle['images'][0] }}" alt="Vehicle Image" class="main-image">
        </div>
    @endif

    <!-- Vehicle Characteristics -->
    <div class="characteristics-section">
        <h2 class="section-title">Características</h2>
        <table class="characteristics-table">
            <tr>
                <td>Matriculación</td>
                <td>{{ $vehicle['year'] ?? 'N/A' }}</td>
                <td>Kilómetros</td>
                <td>{{ !empty($vehicle['kilometers']) ? number_format($vehicle['kilometers'], 0, ',', '.') . ' km' : 'N/A' }}</td>
            </tr>
            <tr>
                <td>Combustible</td>
                <td>{{ $vehicle['fuel'] ?? 'N/A' }}</td>
                <td>Cambio</td>
                <td>{{ $vehicle['transmission'] ?? 'N/A' }}</td>
            </tr>
            <tr>
                <td>Tracción</td>
                <td>{{ $vehicle['driveTrain'] ?? 'N/A' }}</td>
                <td>Potencia</td>
                <td>{{ $vehicle['power'] ?? '' }}kW ({{ $vehicle['powerCV'] ?? '' }}CV)</td>
            </tr>
            <tr>
                <td>Plazas</td>
                <td>{{ $vehicle['seats'] ?? 'N/A' }}</td>
                <td>Tipo</td>
                <td>{{ $vehicle['type']['name'] ?? 'N/A' }}</td>
            </tr>
            <tr>
                <td>Color</td>
                <td>{{ $vehicle['color'] ?? 'N/A' }}</td>
                <td>Distintivo</td>
                <td>
                    @if(!empty($vehicle['environmentalLabel']))
                        <span class="env-label label-{{ strtolower($vehicle['environmentalLabel']) }}">
                            Etiqueta {{ strtoupper($vehicle['environmentalLabel']) }}
                        </span>
                    @else
                        N/A
                    @endif
                </td>
            </tr>
            <tr>
                <td>Puertas</td>
                <td>{{ $vehicle['doors'] ?? 'N/A' }}</td>
                <td>Garantía</td>
                <td>{{ $vehicle['warranty'] ?? 'N/A' }} {{ !empty($vehicle['warranty']) ? 'meses' : '' }}</td>
            </tr>
            <tr>
                <td>Carrocería</td>
                <td colspan="3">{{ $vehicle['category']['name'] ?? 'N/A' }}</td>
            </tr>
        </table>
    </div>

    <!-- Technical Specifications -->
    <div style="margin-bottom: 20px;">
        <h2 class="section-title">Ficha técnica</h2>
        <div class="tech-specs">
            <div class="spec-group">
                <div class="spec-title">Medidas y pesos</div>
                @if(!empty($vehicle['height']))
                    <div class="spec-item">
                        <span class="spec-label">Alto</span>
                        <span class="spec-value">{{ $vehicle['height'] }}m</span>
                    </div>
                @endif
                @if(!empty($vehicle['length']))
                    <div class="spec-item">
                        <span class="spec-label">Largo</span>
                        <span class="spec-value">{{ $vehicle['length'] }} m</span>
                    </div>
                @endif
                @if(!empty($vehicle['width']))
                    <div class="spec-item">
                        <span class="spec-label">Ancho</span>
                        <span class="spec-value">{{ $vehicle['width'] }} m</span>
                    </div>
                @endif
                @if(!empty($vehicle['weight']))
                    <div class="spec-item">
                        <span class="spec-label">Peso</span>
                        <span class="spec-value">{{ $vehicle['weight'] }} kg</span>
                    </div>
                @endif
            </div>

            <div class="spec-group">
                <div class="spec-title">Consumo y prestaciones</div>
                @if(!empty($vehicle['maximumSpeed']))
                    <div class="spec-item">
                        <span class="spec-label">Vel. máxima</span>
                        <span class="spec-value">{{ $vehicle['maximumSpeed'] }} km/h</span>
                    </div>
                @endif
                @if(!empty($vehicle['consumption']))
                    <div class="spec-item">
                        <span class="spec-label">Consumo</span>
                        <span class="spec-value">{{ $vehicle['consumption'] }}/100 km</span>
                    </div>
                @endif
                @if(!empty($vehicle['emissions']))
                    <div class="spec-item">
                        <span class="spec-label">Emisiones</span>
                        <span class="spec-value">{{ $vehicle['emissions'] }} g/km</span>
                    </div>
                @endif
            </div>

            <div class="spec-group">
                <div class="spec-title">Motor y transmisión</div>
                @if(!empty($vehicle['engineCapacity']))
                    <div class="spec-item">
                        <span class="spec-label">Cilindrada</span>
                        <span class="spec-value">{{ number_format($vehicle['engineCapacity'], 0, ',', '.') }} cc</span>
                    </div>
                @endif
                <div class="spec-item">
                    <span class="spec-label">Tracción</span>
                    <span class="spec-value">{{ $vehicle['driveTrain'] ?? 'N/A' }}</span>
                </div>
                <div class="spec-item">
                    <span class="spec-label">Cambio</span>
                    <span class="spec-value">{{ $vehicle['transmission'] ?? 'N/A' }}</span>
                </div>
                <div class="spec-item">
                    <span class="spec-label">Potencia</span>
                    <span class="spec-value">{{ $vehicle['power'] ?? '' }}kW ({{ $vehicle['powerCV'] ?? '' }}CV)</span>
                </div>
            </div>
        </div>
    </div>

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
    @if(!empty($vehicle['images']) && count($vehicle['images']) > 0)
        <div class="images-gallery">
            <h2 class="section-title">Algunas fotos del vehículo</h2>
            <div class="gallery-grid">
                @foreach($vehicle['images'] as $index => $image)
                    @if($index < 6) {{-- Limit to 6 images --}}
                        <div>
                            <img src="{{ $image }}" alt="Vehicle Image {{ $index + 1 }}" class="gallery-image">
                            <div style="text-align: center; margin-top: 5px; font-size: 10px; color: #666;">
                                {{ $vehicle['vsbWip'] ?? 'Vehicle Image' }}
                            </div>
                        </div>
                    @endif
                @endforeach
            </div>
        </div>
    @endif

    <!-- Financial Information Details -->
    @if(!empty($vehicle['financialInformation']['descriptionMonthlyPayment']))
        <div class="page-break"></div>
        <div class="characteristics-section">
            <h2 class="section-title">Información de Financiación</h2>
            <div class="description-content">
                <table style="width: 100%; margin-bottom: 15px;">
                    <tr>
                        <td style="padding: 8px; border: 1px solid #ddd; background: #f8f9fa; font-weight: bold; color: #2c5aa0;">Entrada:</td>
                        <td style="padding: 8px; border: 1px solid #ddd;">{{ number_format($vehicle['financialInformation']['deposit'] ?? 0, 0, ',', '.') }}€</td>
                        <td style="padding: 8px; border: 1px solid #ddd; background: #f8f9fa; font-weight: bold; color: #2c5aa0;">Plazo:</td>
                        <td style="padding: 8px; border: 1px solid #ddd;">{{ $vehicle['financialInformation']['financingMonths'] ?? 'N/A' }} meses</td>
                    </tr>
                    <tr>
                        <td style="padding: 8px; border: 1px solid #ddd; background: #f8f9fa; font-weight: bold; color: #2c5aa0;">TIN:</td>
                        <td style="padding: 8px; border: 1px solid #ddd;">{{ $vehicle['financialInformation']['tin'] ?? 'N/A' }}%</td>
                        <td style="padding: 8px; border: 1px solid #ddd; background: #f8f9fa; font-weight: bold; color: #2c5aa0;">TAE:</td>
                        <td style="padding: 8px; border: 1px solid #ddd;">{{ $vehicle['financialInformation']['tae'] ?? 'N/A' }}%</td>
                    </tr>
                </table>

                <div style="font-size: 10px; line-height: 1.5; padding: 10px; background: #fff3cd; border-radius: 4px; border-left: 4px solid #ffc107;">
                    <strong>Condiciones de financiación:</strong><br>
                    {{ $vehicle['financialInformation']['descriptionMonthlyPayment'] }}
                </div>
            </div>
        </div>
    @endif

    </div> <!-- End of content-wrapper -->
@endsection