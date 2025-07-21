{{-- resources/views/pdfs/sections/vehicle-basic-info.blade.php --}}

<style>
/* ===== Card wrapper (white background, rounded corners) ===== */
.vehicle-card{
    display:flex;
    flex-wrap:nowrap;
    background:#fff;
    border-radius:18px;
    overflow:hidden;
    margin-bottom:25px;
    page-break-inside:avoid;
    font-family:Arial, sans-serif;
}

/* ===== Left column – vehicle image ===== */
.vehicle-card__img{
    flex:0 0 30%;
    min-width:200px;
    max-width:300px;
    background:#e6eef6;
    position:relative;
    border-radius:18px 0 0 18px;
    overflow:hidden;
}

.vehicle-card__img img{
    width:100%;
    height:auto;
    display:block;
    object-fit:cover;
    border-radius:18px 0 0 18px;
}

/* ===== Right column – vehicle info ===== */
.vehicle-card__info{
    flex:1 1 70%;
    padding:20px 30px;
    display:flex;
    flex-direction:column;
    justify-content:space-between;
}

/* ----- Top block: reference + name + version ----- */
.vehicle-ref{
    font-size:11px;
    color:#888;
    margin-bottom:4px;
}

.vehicle-name{
    font-size:24px;
    font-weight:800;
    line-height:1.1;
    margin:0 0 4px 0;
    color:#000;
}

.vehicle-version{
    font-size:15px;
    font-weight:400;
    margin:0 0 14px 0;
    color:#616161;
}

/* ----- Pills (fuel, warranty…) ----- */
.pills-container{
    display:flex;
    align-items:center;
    gap:8px;
    margin-bottom:16px;
    flex-wrap:wrap;
}

.pill{
    display:inline-flex;
    align-items:center;
    font-size:11px;
    padding:5px 12px;
    border-radius:16px;
    font-weight:600;
    line-height:1;
}

.pill--fuel{
    background:#8bb4d9;
    color:#fff;
    gap:6px;
}

.pill--warranty{
    background:#6b6b6b;
    color:#fff;
}

/* Environmental "0" circle */
.env-label{
    width:16px;
    height:16px;
    border-radius:50%;
    background:#fff;
    color:#8bb4d9;
    font-weight:700;
    display:inline-flex;
    justify-content:center;
    align-items:center;
    font-family:'Arial',sans-serif;
    font-size:10px;
}

/* ----- Cash price ----- */
.cash-price-section{
    margin-bottom:18px;
}

.cash-price-label{
    font-size:12px;
    font-weight:600;
    color:#4d4d4d;
    display:block;
    margin-bottom:4px;
}

.cash-price-value{
    font-size:20px;
    font-weight:800;
    color:#000;
}

/* ----- Finance box (orange border) ----- */
.finance-box{
    border:2px solid #ffa500;
    border-radius:12px;
    padding:10px 18px;
    display:flex;
    justify-content:space-between;
    align-items:center;
    gap:20px;
}

.finance-item{
    text-align:center;
}

.finance-item-label{
    font-size:11px;
    font-weight:600;
    color:#4d4d4d;
    display:block;
    margin-bottom:4px;
}

.finance-item-value{
    font-size:20px;
    font-weight:800;
    color:#ffa500;
    display:flex;
    align-items:center;
    justify-content:center;
    gap:4px;
}

/* Info icon */
.info-icon{
    width:12px;
    height:12px;
    fill:#4d4d4d;
    vertical-align:middle;
}

/* Pricing section layout */
.pricing-section{
    display:flex;
    justify-content:flex-end;
    gap:20px;
    align-items:flex-end;
}

.price-item{
    text-align:right;
}
</style>

@php
    /* ---- expected data ----
       $vehicle = [
          'reference'        => '2196398',
          'fullname'         => 'MG eHS',
          'version'          => '1.5T-GDI PHEV Luxury',
          'fuel'             => 'HÍBRIDO ENCHUFABLE (PHEV)',
          'warranty'  => 24,
          'cash_price'       => 28900,
          'financedPrice'       => 28900,
          'price'     => 26900,
          'monthly_quota'    => 305,
          'main_photo'       => $photoUrl
       ];
    */
@endphp

<div class="vehicle-card">
    {{-- ==== PHOTO ==== --}}
    <div class="vehicle-card__img">
        <img src="{{ $vehicle['imageUrl'] ?? '' }}" alt="{{ $vehicle['fullname'] }}">
    </div>

    {{-- ==== INFO ==== --}}
    <div class="vehicle-card__info">
        {{-- Top section --}}
        <div>
             <div class="vehicle-ref">Ref. {{ $vehicle['vsbWip'] ?? $vehicle['reference'] ?? 'N/A' }}</div>
            <h1 class="vehicle-name">{{ $vehicle['fullname'] }}</h1>
            <h2 class="vehicle-version">{{ $vehicle['version'] }}</h2>

            {{-- Pills row --}}
            <div class="pills-container">
                <span class="pill pill--fuel">
                    {{ $vehicle['fuel'] }}
                    <span class="env-label">0</span>
                </span>
                <span class="pill pill--warranty">{{ $vehicle['warranty'] }} MESES DE GARANTÍA</span>
            </div>
        </div>

        {{-- Bottom section: Pricing --}}
        <div class="pricing-section">
            {{-- Cash price --}}
            <div class="price-item">
                <span class="cash-price-label">Precio al contado:</span>
                <span class="cash-price-value">
                    {{ number_format($vehicle['price'], 0, '', '.') }}€
                </span>
            </div>

            {{-- Finance box --}}
            <div class="finance-box">
                <div class="finance-item">
                    <span class="finance-item-label">Precio financiado:</span>
                    <span class="finance-item-value">
                        {{ number_format($vehicle['financedPrice'], 0, '', '.') }}€
                    </span>
                </div>

                <div class="finance-item">
                    <span class="finance-item-label">Cuota mensual:</span>
                    <span class="finance-item-value">
                        {{ number_format($vehicle['financialInformation']['monthlyPayment'], 0, '', '.') }}€
                        <svg class="info-icon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 17 17">
                            <path fill-rule="evenodd" clip-rule="evenodd"
                                  d="M9.487 12.993H7.366V6.267h2.121v6.726Zm.148-8.752c0-.349-.113-.63-.339-.843-.226-.214-.52-.32-.881-.32-.362 0-.655.106-.879.32-.224.213-.335.494-.335.843 0 .345.111.623.335.834.224.211.517.317.879.317.361 0 .655-.106.881-.317.226-.211.339-.49.339-.834ZM8.496 1.832c3.679 0 6.672 2.993 6.672 6.672 0 3.679-2.993 6.672-6.672 6.672-3.679 0-6.672-2.993-6.672-6.672 0-3.679 2.993-6.672 6.672-6.672Zm0 14.344c4.699 0 8.335-3.636 8.335-8.335 0-4.699-3.636-8.335-8.335-8.335C3.797-.166.161 3.47.161 8.169c0 4.699 3.636 8.335 8.335 8.335Z"/>
                        </svg>
                    </span>
                </div>
            </div>
        </div>
    </div>
</div>
