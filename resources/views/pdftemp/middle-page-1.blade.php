<div style="margin-top: 80px; margin-bottom: 100px; padding: 0 25px;">
    <!-- Hero Section -->
    <div style="display: flex; gap: 25px; align-items: flex-start; margin-bottom: 30px;">
        <!-- Vehicle Image -->
        <div style="flex: 0 0 360px;">
            <img src="{{ $vehicle['imageUrl'] ?? '' }}" alt="Vehicle Image" style="width: 360px; height: 260px; object-fit: cover; border-radius: 8px;">
        </div>
        
        <!-- Vehicle Info -->
        <div style="flex: 1;">
            <!-- Vehicle ID -->
            <div style="font-size: 16px; font-weight: 600; color: #666; margin-bottom: 8px;">
                {{ $vehicle['vsbWip'] ?? '' }}
            </div>
            
            <!-- Reference -->
            <div style="font-size: 14px; font-weight: 700; margin-bottom: 15px;">
                Ref. {{ $vehicle['vsbWip'] ?? '' }}
            </div>
            
            <!-- Vehicle Name -->
            <div style="font-size: 28px; font-weight: 700; line-height: 1.2; margin-bottom: 5px;">
                {{ $vehicle['make'] ?? '' }} {{ $vehicle['model'] ?? '' }}
            </div>
            
            <!-- Version -->
            <div style="font-size: 18px; font-weight: 600; margin-bottom: 10px;">
                {{ $vehicle['version'] ?? '' }}
            </div>
            
            <!-- Fuel Type and Environmental Label -->
            <div style="margin-bottom: 8px;">
                <span style="font-size: 14px; font-weight: 600;">{{ strtoupper($vehicle['fuel'] ?? '') }}</span>
                @if(!empty($vehicle['environmentalLabel'] ?? null))
                    <span style="background: #E3F0FD; color: #2361B5; padding: 3px 12px; border-radius: 15px; font-size: 12px; margin-left: 10px;">
                        Etiqueta {{ strtoupper($vehicle['environmentalLabel']) }}
                    </span>
                @endif
            </div>
            
            <!-- Warranty -->
            @if(!empty($vehicle['warranty'] ?? null))
                <div style="font-size: 14px; margin-bottom: 20px;">
                    {{ $vehicle['warranty'] }} MESES DE GARANTÍA
                </div>
            @endif
            
            <!-- Pricing Section -->
            <div style="background: #f8f9fa; padding: 15px; border-radius: 8px; margin-bottom: 15px;">
                <div style="margin-bottom: 8px;">
                    <span style="background: #FFC800; color: #000; padding: 4px 10px; border-radius: 6px; font-size: 12px; font-weight: 600;">Precio financiado:</span>
                    <span style="font-size: 24px; font-weight: 700; margin-left: 10px;">
                        @if(isset($vehicle['financialInformation']['financedPrice']))
                            {{ number_format($vehicle['financialInformation']['financedPrice'], 0, ',', '.') }}€
                        @else
                            N/A
                        @endif
                    </span>
                </div>
                
                <div style="margin-bottom: 8px;">
                    <span style="background: #FFC800; color: #000; padding: 4px 10px; border-radius: 6px; font-size: 12px; font-weight: 600;">Precio al contado:</span>
                    <span style="font-size: 24px; font-weight: 700; margin-left: 10px;">{{ number_format($vehicle['price'] ?? 0, 0, ',', '.') }}€</span>
                </div>
                
                <div>
                    <span style="background: #FFC800; color: #000; padding: 4px 10px; border-radius: 6px; font-size: 12px; font-weight: 600;">Cuota mensual:</span>
                    <span style="font-size: 24px; font-weight: 700, margin-left: 10px;">
                        @if(isset($vehicle['financialInformation']['monthlyPayment']))
                            {{ number_format($vehicle['financialInformation']['monthlyPayment'], 0, ',', '.') }}€
                        @else
                            N/A
                        @endif
                    </span>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Características Section -->
    <div style="margin-top: 40px;">
        <h2 style="font-size: 20px; font-weight: 800; margin-bottom: 15px; color: #000;">Características</h2>
        
        <div style="border: 1px solid #EAEDF1; border-radius: 16px; padding: 20px; background: #fff;">
            <div style="display: grid; grid-template-columns: repeat(3, 1fr); gap: 20px 15px;">
                <!-- Matriculación -->
                <div>
                    <div style="font-size: 10px; text-transform: uppercase; color: #6f6f6f; margin-bottom: 3px;">MATRICULACIÓN</div>
                    <div style="font-size: 14px; font-weight: 700;">{{ $vehicle['year'] ?? 'N/A' }}</div>
                </div>
                
                <!-- Kilómetros -->
                <div>
                    <div style="font-size: 10px; text-transform: uppercase; color: #6f6f6f; margin-bottom: 3px;">KILÓMETROS</div>
                    <div style="font-size: 14px; font-weight: 700;">{{ isset($vehicle['kilometers']) ? number_format($vehicle['kilometers'], 0, ',', '.') : '0' }} km</div>
                </div>
                
                <!-- Combustible -->
                <div>
                    <div style="font-size: 10px; text-transform: uppercase; color: #6f6f6f; margin-bottom: 3px;">COMBUSTIBLE</div>
                    <div style="font-size: 14px; font-weight: 700;">{{ $vehicle['fuel'] ?? 'N/A' }}</div>
                </div>
                
                <!-- Cambio -->
                <div>
                    <div style="font-size: 10px; text-transform: uppercase; color: #6f6f6f; margin-bottom: 3px;">CAMBIO</div>
                    <div style="font-size: 14px; font-weight: 700;">{{ $vehicle['transmission'] ?? 'N/A' }}</div>
                </div>
                
                <!-- Tracción -->
                <div>
                    <div style="font-size: 10px; text-transform: uppercase; color: #6f6f6f; margin-bottom: 3px;">TRACCIÓN</div>
                    <div style="font-size: 14px; font-weight: 700;">{{ $vehicle['driveTrain'] ?? 'N/A' }}</div>
                </div>
                
                <!-- Potencia -->
                <div>
                    <div style="font-size: 10px; text-transform: uppercase; color: #6f6f6f; margin-bottom: 3px;">POTENCIA</div>
                    <div style="font-size: 14px; font-weight: 700;">{{ $vehicle['power'] ?? 'N/A' }}kW ({{ $vehicle['powerCV'] ?? 'N/A' }}CV)</div>
                </div>
                
                <!-- Plazas -->
                <div>
                    <div style="font-size: 10px; text-transform: uppercase; color: #6f6f6f; margin-bottom: 3px;">PLAZAS</div>
                    <div style="font-size: 14px; font-weight: 700;">{{ $vehicle['seats'] ?? 'N/A' }}</div>
                </div>
                
                <!-- Tipo -->
                <div>
                    <div style="font-size: 10px; text-transform: uppercase; color: #6f6f6f; margin-bottom: 3px;">TIPO</div>
                    <div style="font-size: 14px; font-weight: 700;">
                        {{ is_array($vehicle['type'] ?? null) ? ($vehicle['type']['name'] ?? 'N/A') : ($vehicle['type'] ?? 'N/A') }}
                    </div>
                </div>
                
                <!-- Color -->
                <div>
                    <div style="font-size: 10px; text-transform: uppercase; color: #6f6f6f; margin-bottom: 3px;">COLOR</div>
                    <div style="font-size: 14px; font-weight: 700;">{{ $vehicle['color'] ?? 'N/A' }}</div>
                </div>
                
                <!-- Distintivo -->
                <div>
                    <div style="font-size: 10px; text-transform: uppercase; color: #6f6f6f; margin-bottom: 3px;">DISTINTIVO</div>
                    <div style="font-size: 14px; font-weight: 700;">Etiqueta {{ strtoupper($vehicle['environmentalLabel'] ?? 'N/A') }}</div>
                </div>
                
                <!-- Puertas -->
                <div>
                    <div style="font-size: 10px; text-transform: uppercase; color: #6f6f6f; margin-bottom: 3px;">PUERTAS</div>
                    <div style="font-size: 14px; font-weight: 700;">{{ $vehicle['doors'] ?? 'N/A' }}</div>
                </div>
                
                <!-- Garantía -->
                <div>
                    <div style="font-size: 10px; text-transform: uppercase; color: #6f6f6f; margin-bottom: 3px;">GARANTÍA</div>
                    <div style="font-size: 14px; font-weight: 700;">{{ $vehicle['warranty'] ?? 'N/A' }} meses</div>
                </div>
                
                <!-- Carrocería -->
                <div>
                    <div style="font-size: 10px; text-transform: uppercase; color: #6f6f6f; margin-bottom: 3px;">CARROCERÍA</div>
                    <div style="font-size: 14px; font-weight: 700;">
                        {{ is_array($vehicle['category'] ?? null) ? ($vehicle['category']['name'] ?? 'N/A') : ($vehicle['category'] ?? 'N/A') }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Page Break -->
<div style="page-break-after: always;"></div>
