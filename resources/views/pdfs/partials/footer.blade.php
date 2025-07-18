<style>

    .black-footer {
        background-color: black;
        color: white;
        -webkit-print-color-adjust: exact;
        print-color-adjust: exact;
        width: 100%;
        margin: 0;
        padding: 0;
        box-sizing: border-box;
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        height: 60px; 
        display: flex;
        align-items: center;
    }
    

</style>


{{-- footer.blade.php --}}
<div class="footer-wrapper" style="
    margin-top: 30px;
    font-family: Arial, sans-serif;
    page-break-inside: avoid;
    border-radius: 4px;
    overflow: hidden;
    box-shadow: 0 2px 4px rgba(0,0,0,0.1);
">
    {{-- Light Gray Legal Section --}}
    <div class="legal-section" style="
        background-color: #c5c7c0ff !important;
        border: 1px solid #dee2e6;
        padding: 20px;
        margin: 0;
        color: #212529;
        font-size: 10px;
        line-height: 1.5;
    ">
        <h4 style="
            color: #212529;
            margin: 0 0 12px 0;
            font-size: 12px;
            font-weight: bold;
        ">Aviso legal</h4>
        
        <p style="margin: 0 0 12px 0; text-align: justify;">
            La información incluida en este folleto electrónico tiene un carácter meramente informativo. 
            Ha sido generada en el momento de su descarga y está sujeta a posibles modificaciones sin previo aviso. 
            En QUADIS nos esforzamos por garantizar que los datos, especificaciones y precios mostrados sean lo más precisos 
            y actuales posible. No obstante, pueden producirse errores o variaciones.
        </p>
        
        <p style="margin: 0;">
            Para consultar la información actualizada sobre este vehículo, por favor visita: 
            <strong style="color: #212529;">www.quadis.es</strong>
        </p>
    </div>
    
    {{-- Black Footer Section --}}
    <div class="black-footer" >
        <div style="display: inline-block;">
            {{-- Logo --}}
            <div style="margin-bottom: 8px;">
                @if(isset($header_logo) && !empty($header_logo))
                    <img src="{{ $header_logo }}" alt="QUADIS.es" style="
                        height: 35px;
                        max-width: 150px;
                        filter: brightness(0) invert(1);
                        vertical-align: middle;
                    ">
                @else
                    <div style="
                        color: #ffffff;
                        font-size: 18px;
                        font-weight: bold;
                        margin-bottom: 8px;
                    ">QUADIS.es</div>
                @endif
            </div>
            
            {{-- Contact Text --}}
            <div style="
                font-size: 13px;
                color: #ffffff !important;
                font-weight: normal;
                margin-top: 5px;
            ">
                ¿Tienes dudas? ¡Llámanos al 900 100 102!
            </div>
        </div>
    </div>
</div>
