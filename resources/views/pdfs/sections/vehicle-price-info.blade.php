    <div class="price-section">
        <div class="price-grid">
            @if(!empty($vehicle['financedPrice']))
                <div class="price-item">
                    <div class="price-label">Precio financiado:</div>
                    <div class="price-value financed">{{ number_format($vehicle['financedPrice'], 0, ',', '.') }}€</div>
                </div>
            @endif

            @if(!empty($vehicle['price']))
                <div class="price-item">
                    <div class="price-label">Precio al contado:</div>
                    <div class="price-value">{{ number_format($vehicle['price'], 0, ',', '.') }}€</div>
                </div>
            @endif

            @if(!empty($vehicle['financialInformation']['monthlyPayment']))
                <div class="price-item">
                    <div class="price-label">Cuota mensual:</div>
                    <div class="price-value monthly">{{ $vehicle['financialInformation']['monthlyPayment'] }}€</div>
                </div>
            @endif
        </div>
    </div>