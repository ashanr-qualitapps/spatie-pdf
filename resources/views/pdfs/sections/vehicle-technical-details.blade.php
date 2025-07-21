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