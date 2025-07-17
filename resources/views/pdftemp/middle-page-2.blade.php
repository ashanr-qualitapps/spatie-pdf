<div style="margin-top: 80px; margin-bottom: 100px; padding: 0 25px;">
    <!-- Ficha Técnica -->
    <div style="margin-bottom: 30px;">
        <h2 style="font-size: 20px; font-weight: 800; margin-bottom: 15px; color: #000;">Ficha técnica</h2>
        
        <div style="border: 1px solid #EAEDF1; border-radius: 16px; padding: 20px; background: #fff;">
            <div style="display: grid; grid-template-columns: repeat(4, 1fr); gap: 20px 15px;">
                <!-- Alto -->
                <div>
                    <div style="font-size: 10px; text-transform: uppercase; color: #6f6f6f; margin-bottom: 3px;">ALTO</div>
                    <div style="font-size: 14px; font-weight: 700;">{{ $vehicle['height'] ?? 'N/A' }}m</div>
                </div>
                
                <!-- Largo -->
                <div>
                    <div style="font-size: 10px; text-transform: uppercase; color: #6f6f6f; margin-bottom: 3px;">LARGO</div>
                    <div style="font-size: 14px; font-weight: 700;">{{ $vehicle['length'] ?? 'N/A' }}m</div>
                </div>
                
                <!-- Ancho -->
                <div>
                    <div style="font-size: 10px; text-transform: uppercase; color: #6f6f6f; margin-bottom: 3px;">ANCHO</div>
                    <div style="font-size: 14px; font-weight: 700;">{{ $vehicle['width'] ?? 'N/A' }}m</div>
                </div>
                
                <!-- Velocidad máxima -->
                <div>
                    <div style="font-size: 10px; text-transform: uppercase; color: #6f6f6f; margin-bottom: 3px;">VEL. MÁXIMA</div>
                    <div style="font-size: 14px; font-weight: 700;">{{ $vehicle['maximumSpeed'] ?? 'N/A' }} km/h</div>
                </div>
                
                <!-- Consumo -->
                <div>
                    <div style="font-size: 10px; text-transform: uppercase; color: #6f6f6f; margin-bottom: 3px;">CONSUMO</div>
                    <div style="font-size: 14px; font-weight: 700;">{{ $vehicle['consumption'] ?? 'N/A' }}</div>
                </div>
                
                <!-- Cilindrada -->
                <div>
                    <div style="font-size: 10px; text-transform: uppercase; color: #6f6f6f; margin-bottom: 3px;">CILINDRADA</div>
                    <div style="font-size: 14px; font-weight: 700;">{{ $vehicle['engineCapacity'] ?? 'N/A' }} cc</div>
                </div>
                
                <!-- Cambio -->
                <div>
                    <div style="font-size: 10px; text-transform: uppercase; color: #6f6f6f; margin-bottom: 3px;">CAMBIO</div>
                    <div style="font-size: 14px; font-weight: 700;">{{ $vehicle['transmission'] ?? 'N/A' }}</div>
                </div>
                
                <!-- Potencia -->
                <div>
                    <div style="font-size: 10px; text-transform: uppercase; color: #6f6f6f; margin-bottom: 3px;">POTENCIA</div>
                    <div style="font-size: 14px; font-weight: 700;">{{ $vehicle['power'] ?? 'N/A' }}kW ({{ $vehicle['powerCV'] ?? 'N/A' }}CV)</div>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Otros Datos Relevantes -->
    <div style="margin-bottom: 30px;">
        <h2 style="font-size: 20px; font-weight: 800; margin-bottom: 15px; color: #000;">Otros datos relevantes</h2>
        
        <div style="border: 1px solid #EAEDF1; border-radius: 16px; padding: 20px; background: #fff;">
            <div style="font-size: 12px; line-height: 1.5; white-space: pre-line;">{{ $vehicle['description2'] ?? 'No hay datos adicionales disponibles.' }}</div>
        </div>
    </div>
    
    <!-- Description Text -->
    <div style="font-size: 12px; line-height: 1.6; white-space: pre-line; color: #232323;">
        {{ $vehicle['description'] ?? 'No hay descripción disponible para este vehículo.' }}
    </div>
</div>

<!-- Page Break -->
<div style="page-break-after: always;"></div>
