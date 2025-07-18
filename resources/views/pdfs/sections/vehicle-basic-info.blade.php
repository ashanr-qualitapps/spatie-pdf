{{-- resources/views/pdfs/sections/vehicle-basic-info.blade.php --}}

<style>
/* ===== Card wrapper (white background, rounded corners) ===== */
.vehicle-card{
    display:flex;
    flex-wrap:wrap;
    background:#fff;
    border-radius:18px;
    overflow:hidden;
    margin-bottom:25px;
    page-break-inside:avoid;          /* keep card on same PDF page */
    font-family:Arial, sans-serif;
}

/* ===== Left column – main photo ===== */
.vehicle-card__img{
    flex:1 1 55%;                     /* grow / shrink / basis */
    min-width:270px;
    background:#e6eef6;               /* same light-blue you see in screenshot */
    position:relative;
}
.vehicle-card__img img{
    width:100%;
    height:auto;
    display:block;
    object-fit:cover;
    border-radius:18px 0 0 18px;      /* keep the rounded corner only on left */
}

/* ===== Right column ===== */
.vehicle-card__info{
    flex:1 1 45%;
    padding:26px 30px 22px 30px;
    display:flex;
    flex-direction:column;
    justify-content:space-between;
}

/* ----- Top block: reference + name + version ----- */
.vehicle-ref{font-size:12px;color:#666;margin-bottom:4px;}
.vehicle-name{font-size:28px;font-weight:700;line-height:1.1;margin:0;}
.vehicle-version{font-size:18px;font-weight:400;margin:2px 0 16px 0;}

/* ----- Pills (fuel, warranty…) ----- */
.pill{
    display:inline-flex;
    align-items:center;
    font-size:12px;
    padding:3px 10px;
    border-radius:12px;
    margin-right:6px;
    margin-bottom:6px;
    line-height:1;
}
.pill--electric      {background:#5664ff;color:#fff;}
.pill--warranty      {background:#e9e9e9;color:#161616;font-weight:600;}

/* environmental “0” circle */
.env-label{
    width:34px;height:34px;border-radius:50%;
    background:#50b9fd;color:#000;
    font-weight:700;display:inline-flex;justify-content:center;align-items:center;
    font-family:'Arial',sans-serif;font-size:18px;margin-right:6px;
}

/* ----- Cash price (right-aligned big bold) ----- */
.cash-price-label{font-size:14px;font-weight:700;margin-bottom:2px;}
.cash-price-value{font-size:24px;font-weight:700;}

/* ----- Finance box (orange border) ----- */
.finance-box{
    border:2px solid #f5a100;         /* orange */
    border-radius:12px;
    padding:14px 20px;
    display:flex;
    justify-content:space-between;
    align-items:center;
    margin-top:22px;
}
.finance-item-label {font-size:14px;font-weight:600;}
.finance-item-value {font-size:22px;font-weight:700;color:#f5a100;}
/* small “i” icon – static SVG */
.info-icon{
    width:14px;height:14px;fill:#000;margin-left:4px;vertical-align:middle;
}
</style>


@php
    /* ---- expected data ----
       $vehicle = [
          'reference'        => '2106308',
          'fullname'             => 'MG eHS',
          'version'          => '1.5T-GDI PHEV Luxury',
          'fuel'             => 'HIBRIDO ENCHUFABLE (PHEV)',
          'warranty_months'  => 24,
          'cash_price'       => 28900,
          'funded_price'     => 26900,
          'monthly_quota'    => 305,
          'main_photo'       => $photoUrl
       ];
    */
@endphp

<div class="vehicle-card">
    {{-- ==== PHOTO ==== --}}
    <div class="vehicle-card__img">
        <img src="{{ $vehicle['imageUrl'] ?? $vehicle['imageUrl'] }}" alt="{{ $vehicle['fullname'] }}">
    </div>

    {{-- ==== INFO ==== --}}
    <div class="vehicle-card__info">

        {{-- top section --}}
        <div>
            <div class="vehicle-ref">Ref. {{ $vehicle['vsbWip'] }}</div>
            <h1 class="vehicle-name">{{ $vehicle['fullname'] }}</h1>
            <h2 class="vehicle-version">{{ $vehicle['version'] }}</h2>

            {{-- pills row --}}
            <div class="mb-3">
                <span class="pill pill--electric">{{ $vehicle['fuel'] }}</span>
                <span class="env-label">0</span>
                <span class="pill pill--warranty">{{ $vehicle['warranty'] }} MESES DE GARANTÍA</span>
            </div>

            {{-- cash price --}}
            <div>
                <span class="cash-price-label">Precio al contado:</span><br>
                <span class="cash-price-value">
                    {{ number_format($vehicle['price'], 0, ',', '.') }}€
                </span>
            </div>
        </div>


        {{-- finance box --}}
        <div class="finance-box">
            <div>
                <div class="finance-item-label">Precio financiado:</div>
                <div class="finance-item-value">
                    {{ number_format($vehicle['financedPrice'], 0, ',', '.') }}€
                </div>
            </div>

            <div>
                <div class="finance-item-label">Cuota mensual:</div>
                <div class="finance-item-value">
                    {{ number_format($vehicle['financialInformation']['monthlyPayment'], 0, ',', '.') }}€
                    {{-- static “i” icon --}}
                    <svg class="info-icon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 17 17">
                        <path fill-rule="evenodd" clip-rule="evenodd"
                              d="M9.487 12.993H7.366V6.267h2.121v6.726Zm.148-8.752c0-.349-.113-.63-.339-.843-.226-.214-.52-.32-.881-.32-.362 0-.655.106-.879.32-.224.213-.335.494-.335.843 0 .345.111.623.335.834.224.211.517.317.879.317.361 0 .655-.106.881-.317.226-.211.339-.49.339-.834ZM8.496 1.832c3.679 0 6.672 2.993 6.672 6.672 0 3.679-2.993 6.672-6.672 6.672-3.679 0-6.672-2.993-6.672-6.672 0-3.679 2.993-6.672 6.672-6.672Zm0 14.344c4.699 0 8.335-3.636 8.335-8.335 0-4.699-3.636-8.335-8.335-8.335C3.797-.166.161 3.47.161 8.169c0 4.699 3.636 8.335 8.335 8.335Z"/>
                    </svg>
                </div>
            </div>
        </div>
    </div>
</div>
