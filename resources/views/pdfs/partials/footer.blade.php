<style>
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
        background-color: #c5c7c0 !important; /* Hex codes don't need the 'ff' alpha part */
        border: 1px solid #dee2e6;
        padding: 20px;
        color: #212529;
        font-size: 10px;
        line-height: 1.5;
    }
    .legal-section__title {
        color: #212529;
        margin: 0 0 12px 0;
        font-size: 12px;
        font-weight: bold;
    }
    .legal-section__text {
        margin: 0 0 12px 0;
        text-align: justify;
    }
    .legal-section__text--last {
        margin-bottom: 0;
        text-align: left; /* The last paragraph was not justified */
    }
    .legal-section__link {
        color: #212529;
        font-weight: bold;
    }

    /* --- Black Footer Section --- */
    .black-footer {
        background-color: #000;
        color: #fff;
        padding: 20px;
        text-align: center;
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
</div>
