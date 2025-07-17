@extends('pdfs.layouts.vehicle-multipage', ['page' => 3])

@section('title', 'QUADIS.es - ' . ($vehicle['make'] ?? '') . ' ' . ($vehicle['model'] ?? '') . ' - Página 3')

@section('page1-content')
    <div class="page-break"></div>
    
    <!-- Subtle vehicle identifier on page 3 -->
    <div style="margin-bottom: 20px; border-bottom: 1px solid #eee; padding-bottom: 10px;">
        <div style="font-size: 14px; font-weight: bold; color: #2c5aa0;">
            {{ $vehicle['make'] ?? '' }} {{ $vehicle['model'] ?? '' }} {{ $vehicle['version'] ?? '' }}
        </div>
        <div style="font-size: 11px; color: #666;">
            Ref: {{ $vehicle['vsbWip'] ?? 'N/A' }}
        </div>
    </div>
    
    <!-- Images Gallery -->
    @if(!empty($vehicle['images']) && count($vehicle['images']) > 0)
        <div class="images-gallery">
            <h2 class="section-title">Galería de imágenes</h2>
            <div class="gallery-grid">
                @foreach($vehicle['images'] as $index => $image)
                    @if($index < 6) {{-- Limit to 6 images --}}
                        <div>
                            <img src="{{ $image }}" alt="Vehicle Image {{ $index + 1 }}" class="gallery-image">
                            <div style="text-align: center; margin-top: 5px; font-size: 10px; color: #666;">
                                {{ $vehicle['make'] ?? '' }} {{ $vehicle['model'] ?? '' }}
                            </div>
                        </div>
                    @endif
                @endforeach
            </div>
        </div>
    @endif

    <!-- Financial Information Details -->
    @if(!empty($vehicle['financialInformation']))
        <div style="margin-top: 30px;">
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
                    <tr>
                        <td style="padding: 8px; border: 1px solid #ddd; background: #f8f9fa; font-weight: bold; color: #2c5aa0;">Cuota mensual:</td>
                        <td style="padding: 8px; border: 1px solid #ddd;">{{ $vehicle['financialInformation']['monthlyPayment'] ?? 'N/A' }}€</td>
                        <td style="padding: 8px; border: 1px solid #ddd; background: #f8f9fa; font-weight: bold; color: #2c5aa0;">Última cuota:</td>
                        <td style="padding: 8px; border: 1px solid #ddd;">{{ $vehicle['financialInformation']['lastPayment'] ?? 'N/A' }}€</td>
                    </tr>
                </table>

                @if(!empty($vehicle['financialInformation']['descriptionMonthlyPayment']))
                    <div style="font-size: 10px; line-height: 1.5; padding: 10px; background: #fff3cd; border-radius: 4px; border-left: 4px solid #ffc107;">
                        <strong>Condiciones de financiación:</strong><br>
                        {{ $vehicle['financialInformation']['descriptionMonthlyPayment'] }}
                    </div>
                @endif
            </div>
        </div>
    @endif

    <!-- Contact and location information -->
    <div style="margin-top: 30px; background: #f8f9fa; padding: 15px; border-radius: 8px;">
        <h2 class="section-title">¿Dónde ver este vehículo?</h2>
        
        <div style="display: flex; justify-content: space-between;">
            <div style="flex: 1;">
                <p style="margin-bottom: 5px;"><strong>Centro QUADIS</strong></p>
                <p>{{ $vehicle['location']['name'] ?? 'Concesionario QUADIS' }}</p>
                <p>{{ $vehicle['location']['address'] ?? '' }}</p>
                <p>{{ $vehicle['location']['city'] ?? '' }}, {{ $vehicle['location']['postalCode'] ?? '' }}</p>
            </div>
            <div style="flex: 1; text-align: right;">
                <p style="margin-bottom: 5px;"><strong>Contacto</strong></p>
                <p>Teléfono: 900 100 102</p>
                <p>Email: info@quadis.es</p>
                <p>www.quadis.es</p>
            </div>
        </div>
    </div>
@endsection
