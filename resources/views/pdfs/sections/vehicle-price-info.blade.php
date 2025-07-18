{{-- resources/views/pdfs/sections/vehicle-price-info.blade.php --}}

<style>
    /* ===== Finance block ===== */
    #div-vehicle-data-finance{
        font-family: Arial, sans-serif;
        padding: 12px 0;
        margin-top: 10px;
        /* keeps the block together when the PDF paginates */
        page-break-inside: avoid;
    }

    /* inner white box */
    #div-vehicle-data-finance .vehicle-monthly{
        border-top: 1px solid #e5e5e5;
        padding: 16px 8px;
    }

    /* “Funded price / Monthly quota” label */
    .vehicle-price-text{
        font-size: 12px;
        font-weight: 700;
    }

    /* numeric price */
    .vehicle-price{
        font-size: 22px;
        font-weight: 700;
        line-height: 1.1;
    }

    .text-orange{ color:#ff7b00; }

    .vehicle-price-iva{
        font-size: 10px;
        color:#727272;
    }

    /* small “i” tooltip icon (static for PDF) */
    .info-icon{
        width: 17px;
        height: 17px;
        fill:#000;
        vertical-align: middle;
    }
</style>


@php
    $finance = $vehicle['financialInformation'] ?? [];
@endphp

<div id="div-vehicle-data-finance" class="vehicle-data-finance col-12 offset-md-1 offset-lg-0 pl-4 pr-0 py-3 order-6 order-lg-5">
    <div class="row pb-3 pb-lg-0">
        <div class="container vehicle-monthly">
            <div class="row px-1">
                {{-- -------- Funded price -------- --}}
                <div class="col">
                    <span class="vehicle-price-text">Funded price:</span>
                    <span class="d-block vehicle-price text-orange">
                        {{ number_format($vehicle['financedPrice'] ?? 0, 0, ',', '.') }}€
                    </span>

                    <div class="row align-items-center mt-1">
                        <div class="col px-0">
                            <span class="vehicle-price-iva">VAT included</span>
                        </div>
                    </div>
                </div>

                {{-- -------- Monthly quota -------- --}}
                <div class="col pl-0">
                    <span class="vehicle-price-text">Monthly quota:</span>
                    <span class="d-block vehicle-price text-orange">
                        <span class="vehicle-price-value">
                            {{ number_format($finance['monthlyPayment'] ?? 0, 0, ',', '.') }}€
                        </span>

                        {{-- tooltip “i” (static in PDF) --}}
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
