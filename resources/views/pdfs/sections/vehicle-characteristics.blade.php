<style>
    /* ===== Wrapper ===== */
    .ch-section{font-family:Arial, sans-serif;margin:30px 0;page-break-inside:avoid;}
    .ch-title  {font-size:24px;font-weight:700;text-align:center;margin-bottom:18px;}

    /* ===== Rounded box ===== */
    .ch-box{
        border:2px solid #f5a100;           /* orange stroke */
        border-radius:26px;
        padding:17px 20px;
        -webkit-print-color-adjust:exact;
        print-color-adjust:exact;
    }

    /* ===== Grid (2 cols × n rows) ===== */
    .ch-grid{
        display:grid;
        grid-template-columns:repeat(2,1fr);
        grid-column-gap:48px;
        grid-row-gap:28px;
    }

    /* ===== Single item ===== */
    .ch-item{display:flex;align-items:flex-start;}
    .ch-item img{width:22px;height:22px;margin-right:12px;}

    .ch-label {font-size:12px;color:#6d6d6d;}
    .ch-value {font-size:14px;font-weight:700;display:block;}

    /* Pills */
    .pill        {display:inline-block;padding:2px 8px;border-radius:10px;font-size:10px;font-weight:600;line-height:1;}
    .pill--blue  {background:#6f84ff;color:#fff;}
    .pill--sky   {background:#50b9fd;color:#000;}
</style>


<div class="ch-section">
    <h2 class="ch-title">Características</h2>

    <div class="ch-box">
        <div class="ch-grid">
            {{-- Matriculación --}}
            <div class="ch-item">
                <img src="{{ $icons['fuel'] }}" alt="">
                <div>
                    <span class="ch-label">Matriculación</span>
                    <span class="ch-value">{{ $vehicle['year'] ?? 'N/A' }}</span>
                </div>
            </div>

            {{-- Kilómetros --}}
            <div class="ch-item">
                <img src="{{ $icons['fuel'] }}" alt="">
                <div>
                    <span class="ch-label">Kilómetros</span>
                    <span class="ch-value">
                        {{ !empty($vehicle['kilometers'])
                            ? number_format($vehicle['kilometers'],0,',','.').' km'
                            : 'N/A' }}
                    </span>
                </div>
            </div>

            {{-- Combustible --}}
            <div class="ch-item">
                <img src="{{ $icons['fuel'] }}" alt="">
                <div>
                    <span class="ch-label">Combustible</span>
                    <span class="ch-value">
                        @if(!empty($vehicle['fuel']))
                            <span class="pill pill--blue">{{ strtoupper($vehicle['fuel']) }}</span>
                        @else N/A @endif
                    </span>
                </div>
            </div>

            {{-- Distintivo --}}
            <div class="ch-item">
                <img src="{{ $icons['fuel'] }}" alt="">
                <div>
                    <span class="ch-label">Distintivo</span>
                    <span class="ch-value">
                        @if(!empty($vehicle['environmentalLabel']))
                            <span class="pill pill--sky">Etiqueta {{ strtoupper($vehicle['environmentalLabel']) }}</span>
                        @else N/A @endif
                    </span>
                </div>
            </div>

            {{-- Cambio --}}
            <div class="ch-item">
                <img src="{{ $icons['fuel'] }}" alt="">
                <div>
                    <span class="ch-label">Cambio</span>
                    <span class="ch-value">{{ $vehicle['transmission'] ?? 'N/A' }}</span>
                </div>
            </div>

            {{-- Tracción --}}
            <div class="ch-item">
                <img src="{{ $icons['fuel']}}" alt="">
                <div>
                    <span class="ch-label">Tracción</span>
                    <span class="ch-value">{{ $vehicle['driveTrain'] ?? 'N/A' }}</span>
                </div>
            </div>

            {{-- Potencia --}}
            <div class="ch-item">
                <img src="{{ $icons['fuel'] }}" alt="">
                <div>
                    <span class="ch-label">Potencia</span>
                    <span class="ch-value">
                        {{ ($vehicle['power'] ?? '') }}kW ({{ $vehicle['powerCV'] ?? '' }}CV)
                    </span>
                </div>
            </div>

            {{-- Puertas --}}
            <div class="ch-item">
                <img src="{{ $icons['fuel'] }}" alt="">
                <div>
                    <span class="ch-label">Puertas</span>
                    <span class="ch-value">{{ $vehicle['doors'] ?? 'N/A' }}</span>
                </div>
            </div>

            {{-- Plazas --}}
            <div class="ch-item">
                <img src="{{ $icons['fuel'] }}" alt="">
                <div>
                    <span class="ch-label">Plazas</span>
                    <span class="ch-value">{{ $vehicle['seats'] ?? 'N/A' }}</span>
                </div>
            </div>

            {{-- Color --}}
            <div class="ch-item">
                <img src="{{ $icons['fuel']}}" alt="">
                <div>
                    <span class="ch-label">Color</span>
                    <span class="ch-value">{{ $vehicle['color'] ?? 'N/A' }}</span>
                </div>
            </div>

            {{-- Garantía --}}
            <div class="ch-item">
                <img src="{{ $icons['fuel'] }}" alt="">
                <div>
                    <span class="ch-label">Garantía</span>
                    <span class="ch-value">
                        {{ $vehicle['warranty'] ?? 'N/A' }}
                        {{ !empty($vehicle['warranty']) ? 'meses' : '' }}
                    </span>
                </div>
            </div>

            {{-- Carrocería --}}
            <div class="ch-item">
                <img src="{{ $icons['fuel'] }}" alt="">
                <div>
                    <span class="ch-label">Carrocería</span>
                    <span class="ch-value">{{ $vehicle['category']['name'] ?? 'N/A' }}</span>
                </div>
            </div>

            {{-- Tipo (si existe) --}}
            @if(!empty($vehicle['type']['name']))
                <div class="ch-item">
                    <img src="{{ $icons['fuel'] }}" alt="">
                    <div>
                        <span class="ch-label">Tipo</span>
                        <span class="ch-value">{{ $vehicle['type']['name'] }}</span>
                    </div>
                </div>
            @endif
        </div>
    </div>
</div>
