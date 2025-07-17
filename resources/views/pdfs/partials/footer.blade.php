<div style="margin-top: 30px; font-size: 10px; color: #fff; background-color: #000;">
    <!-- Cache buster: {{ $cache_bust ?? time() }} -->
    <!-- Common legal notice for all pages -->
    <div style="background: #222; padding: 15px; border-radius: 4px; margin-bottom: 10px; color: #fff;">
        <h4 style="color: #fff; margin-bottom: 10px;">Aviso legal</h4>
        <p>La información incluida en este folleto electrónico tiene un carácter meramente informativo. Ha sido generada en el momento de su descarga y está sujeta a posibles modificaciones sin previo aviso. En QUADIS nos esforzamos por garantizar que los datos, especificaciones y precios mostrados sean lo más precisos y actuales posible. No obstante, pueden producirse errores o variaciones.</p>
        <p>Para consultar la información actualizada sobre este vehículo, por favor visita: <strong>www.quadis.es</strong></p>
    </div>
    
    <!-- Footer with logo and contact info -->
    <div style="text-align: center; margin-top: 15px; padding: 10px 0; border-top: 1px solid #444; background-color: #000; color: #fff; border-radius: 4px;">
        <img src="{{ asset('storage/logo-quadis.es-blanco.png') }}?v={{ $cache_bust ?? time() }}" alt="QUADIS.es" style="height: 30px; max-width: 120px; margin-bottom: 5px;">
        <div style="font-size: 12px;">¿Tienes dudas? ¡Llámanos al 900 100 102!</div>
    </div>
    
    <div style="text-align: center; font-size: 10px; color: #ccc; margin-top: 10px;">
        <div>Generado: {{ date('d/m/Y H:i') }}</div>
        <div>www.quadis.es</div>
    </div>
</div>