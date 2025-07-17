@extends('pdfs.layouts.vehicle-multipage', ['page' => 2])

@section('title', 'QUADIS.es - ' . ($vehicle['make'] ?? '') . ' ' . ($vehicle['model'] ?? '') . ' - Página 2')

@section('page1-content')
    <div class="page-break"></div>
    
    <!-- Subtle vehicle identifier on page 2 -->
    <div style="margin-bottom: 20px; border-bottom: 1px solid #eee; padding-bottom: 10px;">
        <div style="font-size: 14px; font-weight: bold; color: #2c5aa0;">
            {{ $vehicle['make'] ?? '' }} {{ $vehicle['model'] ?? '' }} {{ $vehicle['version'] ?? '' }}
        </div>
        <div style="font-size: 11px; color: #666;">
            Ref: {{ $vehicle['vsbWip'] ?? 'N/A' }}
        </div>
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

    <!-- Equipment list -->
    @if(!empty($vehicle['equipment']) && count($vehicle['equipment']) > 0)
        <div class="characteristics-section">
            <h2 class="section-title">Equipamiento</h2>
            <div class="description-content" style="columns: 2; column-gap: 20px;">
                <ul style="list-style-position: inside; padding-left: 5px;">
                    @foreach($vehicle['equipment'] as $item)
                        <li style="break-inside: avoid; margin-bottom: 5px;">{{ $item }}</li>
                    @endforeach
                </ul>
            </div>
        </div>
    @endif
@endsection
