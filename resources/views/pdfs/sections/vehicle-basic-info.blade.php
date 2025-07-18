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