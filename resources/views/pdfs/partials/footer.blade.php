<style>
    @media print {


    /* --- Wrapper and General Layout --- */
    .footer-wrapper {
        margin-top: 30px;
        font-family: Arial, sans-serif;
        page-break-inside: avoid;
        border-radius: 4px;
        overflow: hidden; /* Ensures the child border-radius is respected */
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
    }

    /* --- Light Gray Legal Section --- */
    .legal-section {
        background-color: #f5f5f5 !important;  /* Light gray background */
        padding: 20px 30px;
        border-radius: 0;
        margin: 0;
          width: 100%;
        -webkit-print-color-adjust: exact;      /* Force background colors in PDF */
        print-color-adjust: exact;              /* Standard property */
        color-adjust: exact;                    /* Additional browser support */
    }
}
    .legal-section__title {
        font-size: 14px;
        font-weight: 700;
        color: #333;
        margin: 0 0 12px 0;
    }

    .legal-section__text {
        font-size: 11px;
        line-height: 1.4;
        color: #555;
        margin: 0 0 10px 0;
    }

    .legal-section__text--last {
        margin-bottom: 0;
    }

    .legal-section__link {
        color: #000;
        font-weight: 600;
    }

    /* --- Black Footer Section --- */
    .black-footer {
        background-color: #000 !important;
        color: #fff;
        padding: 20px 30px;
        margin: 0;
        width: 100%;
        -webkit-print-color-adjust: exact;
        print-color-adjust: exact;
    }
    .black-footer__content-wrapper {
        display: inline-block; /* Helps with centering */
    }
    .black-footer__logo-container {
        margin-bottom: 8px;
    }
    .black-footer__logo {
        height: 35px;
        max-width: 150px;
        filter: brightness(0) invert(1); /* Keeps a dark logo white on black */
        vertical-align: middle;
    }
    .black-footer__logo-fallback {
        color: #fff;
        font-size: 18px;
        font-weight: bold;
        margin-bottom: 8px;
    }
    .black-footer__cta-text {
        font-size: 13px;
        color: #fff !important; /* Keeping important as it was in the original style */
        font-weight: normal;
        margin-top: 5px;
    }



</style>


<div class="footer-wrapper">
    {{-- Light Gray Legal Section --}}
    <div class="legal-section">
        <h4 class="legal-section__title">Aviso legal</h4>

        <p class="legal-section__text">
            La información incluida en este folleto electrónico tiene un carácter meramente informativo.
            Ha sido generada en el momento de su descarga y está sujeta a posibles modificaciones sin previo aviso.
            En QUADIS nos esforzamos por garantizar que los datos, especificaciones y precios mostrados sean lo más precisos
            y actuales posible. No obstante, pueden producirse errores o variaciones.
        </p>

        <p class="legal-section__text legal-section__text--last">
            Para consultar la información actualizada sobre este vehículo, por favor visita:
            <strong class="legal-section__link">www.quadis.es</strong>
        </p>
    </div>

    {{-- Only show footer on pages after the second page --}}
@if(isset($showBlackFooter) && $showBlackFooter)
    {{-- Black Footer Section --}}
    <div class="black-footer">
        <div class="black-footer__content-wrapper">
            {{-- Logo --}}
            <div class="black-footer__logo-container">
                @if(isset($footer_logo))
                <img src="{{ $footer_logo }}" alt="QUADIS.es" class="black-footer__logo">
                @else
                    <div class="black-footer__logo-fallback">QUADIS.es</div>
                @endif
            </div>

            {{-- Contact Text --}}
            <div class="black-footer__cta-text">
                Footer
                ¿Tienes dudas? ¡Llámanos al 900 100 102!
            </div>
        </div>
    </div>
    @endif
</div>
