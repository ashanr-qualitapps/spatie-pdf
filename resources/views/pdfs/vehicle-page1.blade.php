@extends('pdfs.layouts.vehicle-multipage', ['page' => 1])

@section('title', 'QUADIS.es - ' . ($vehicle['make'] ?? '') . ' ' . ($vehicle['model'] ?? ''))

@section('page1-content')
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
        </table>
    </div>
@endsection

@section('additional-pages')
    <!-- Page 2 and 3 will be included via the controller -->
@endsection
