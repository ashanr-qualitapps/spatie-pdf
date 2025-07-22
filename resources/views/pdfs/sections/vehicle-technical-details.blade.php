<style>
    /* ===== Wrapper ===== */
    .tech-section{font-family:Arial, sans-serif;margin:20px 0;page-break-inside:avoid;}
    .tech-title  {font-size:20px;font-weight:700;text-align:center;margin-bottom:12px;}

    /* ===== Rounded box ===== */
    .tech-box{
        border:2px solid #f5a100;           /* orange stroke */
        border-radius:18px;
        padding:12px 16px;
        -webkit-print-color-adjust:exact;
        print-color-adjust:exact;
    }

    /* ===== Group titles ===== */
    .group-title {
        font-size:14px;
        font-weight:700;
        margin:10px 0;
        grid-column:1 / -1;
    }

    /* ===== Grid (2 cols × n rows) ===== */
    .tech-grid{
        display:grid;
        grid-template-columns:repeat(2,1fr);
        grid-column-gap:32px;
        grid-row-gap:16px;
    }

    /* ===== Single item ===== */
    .tech-item{display:flex;align-items:flex-start;}
    .tech-item img{width:18px;height:18px;margin-right:8px;}

    .tech-label {font-size:10px;color:#6d6d6d;}
    .tech-value {font-size:12px;font-weight:700;display:block;line-height:1.2;}
</style>

<div class="tech-section">
    <h2 class="tech-title">Ficha técnica</h2>

    <div class="tech-box">
        <div class="tech-grid">
            <!-- Medidas y pesos -->
            <h3 class="group-title">Medidas y pesos</h3>
            
            @if(!empty($vehicle['height']))
            <div class="tech-item">
                <img src="{{ $icons['fuel'] ?? '' }}" alt="">
                <div>
                    <span class="tech-label">Alto</span>
                    <span class="tech-value">{{ $vehicle['height'] }}m</span>
                </div>
            </div>
            @endif

            @if(!empty($vehicle['length']))
            <div class="tech-item">
                <img src="{{ $icons['fuel'] ?? '' }}" alt="">
                <div>
                    <span class="tech-label">Largo</span>
                    <span class="tech-value">{{ $vehicle['length'] }} m</span>
                </div>
            </div>
            @endif

            @if(!empty($vehicle['width']))
            <div class="tech-item">
                <img src="{{ $icons['fuel'] ?? '' }}" alt="">
                <div>
                    <span class="tech-label">Ancho</span>
                    <span class="tech-value">{{ $vehicle['width'] }} m</span>
                </div>
            </div>
            @endif

            @if(!empty($vehicle['weight']))
            <div class="tech-item">
                <img src="{{ $icons['fuel'] ?? '' }}" alt="">
                <div>
                    <span class="tech-label">Peso</span>
                    <span class="tech-value">{{ $vehicle['weight'] }} kg</span>
                </div>
            </div>
            @endif

            <!-- Consumo y prestaciones -->
            <h3 class="group-title">Consumo y prestaciones</h3>
            
            @if(!empty($vehicle['maximumSpeed']))
            <div class="tech-item">
                <img src="{{ $icons['fuel'] ?? '' }}" alt="">
                <div>
                    <span class="tech-label">Vel. máxima</span>
                    <span class="tech-value">{{ $vehicle['maximumSpeed'] }} km/h</span>
                </div>
            </div>
            @endif

            @if(!empty($vehicle['consumption']))
            <div class="tech-item">
                <img src="{{ $icons['fuel'] ?? '' }}" alt="">
                <div>
                    <span class="tech-label">Consumo</span>
                    <span class="tech-value">{{ $vehicle['consumption'] }}/100 km</span>
                </div>
            </div>
            @endif

            @if(!empty($vehicle['emissions']))
            <div class="tech-item">
                <img src="{{ $icons['fuel'] ?? '' }}" alt="">
                <div>
                    <span class="tech-label">Emisiones</span>
                    <span class="tech-value">{{ $vehicle['emissions'] }} g/km</span>
                </div>
            </div>
            @endif

            <!-- Motor y transmisión -->
            <h3 class="group-title">Motor y transmisión</h3>
            
            @if(!empty($vehicle['engineCapacity']))
            <div class="tech-item">
                <img src="{{ $icons['fuel'] ?? '' }}" alt="">
                <div>
                    <span class="tech-label">Cilindrada</span>
                    <span class="tech-value">{{ number_format($vehicle['engineCapacity'], 0, ',', '.') }} cc</span>
                </div>
            </div>
            @endif

            <div class="tech-item">
                <img src="{{ $icons['fuel'] ?? '' }}" alt="">
                <div>
                    <span class="tech-label">Tracción</span>
                    <span class="tech-value">{{ $vehicle['driveTrain'] ?? 'N/A' }}</span>
                </div>
            </div>

            <div class="tech-item">
                <img src="{{ $icons['fuel'] ?? '' }}" alt="">
                <div>
                    <span class="tech-label">Cambio</span>
                    <span class="tech-value">{{ $vehicle['transmission'] ?? 'N/A' }}</span>
                </div>
            </div>

            <div class="tech-item">
                <img src="{{ $icons['fuel'] ?? '' }}" alt="">
                <div>
                    <span class="tech-label">Potencia</span>
                    <span class="tech-value">{{ $vehicle['power'] ?? '' }}kW ({{ $vehicle['powerCV'] ?? '' }}CV)</span>
                </div>
            </div>
        </div>
    </div>
</div>