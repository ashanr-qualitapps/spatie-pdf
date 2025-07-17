<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'QUADIS.es - Información del Vehículo')</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Arial', sans-serif;
            font-size: 12px;
            line-height: 1.4;
            color: #333;
            background: #fff;
        }

        .container {
            max-width: 210mm;
            margin: 0 auto;
            padding: 15mm;
        }

        /* Header Styles */
        .page-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
            padding-bottom: 15px;
            border-bottom: 2px solid #e0e0e0;
        }

        .logo {
            font-size: 24px;
            font-weight: bold;
            color: #2c5aa0;
        }

        .contact-info {
            text-align: right;
            color: #666;
        }

        .phone {
            font-size: 14px;
            font-weight: bold;
            color: #2c5aa0;
        }

        /* Common styles from master.blade.php */
        .vehicle-header {
            background: linear-gradient(135deg, #2c5aa0 0%, #1a4480 100%);
            color: white;
            padding: 20px;
            margin-bottom: 20px;
            border-radius: 8px;
        }

        .vehicle-title {
            font-size: 18px;
            font-weight: bold;
            margin-bottom: 5px;
        }

        .vehicle-version {
            font-size: 14px;
            opacity: 0.9;
            margin-bottom: 10px;
        }

        .vehicle-meta {
            display: flex;
            justify-content: space-between;
            align-items: center;
            flex-wrap: wrap;
        }

        .ref-number {
            font-size: 12px;
            opacity: 0.8;
        }

        .price-section {
            background: #f8f9fa;
            padding: 20px;
            margin-bottom: 20px;
            border-radius: 8px;
            border-left: 4px solid #2c5aa0;
        }

        .price-grid {
            display: grid;
            grid-template-columns: 1fr 1fr 1fr;
            gap: 20px;
            align-items: center;
        }

        .price-item {
            text-align: center;
        }

        .price-label {
            font-size: 11px;
            color: #666;
            margin-bottom: 5px;
        }

        .price-value {
            font-size: 18px;
            font-weight: bold;
            color: #2c5aa0;
        }

        .section-title {
            font-size: 16px;
            font-weight: bold;
            color: #2c5aa0;
            margin-bottom: 15px;
            padding-bottom: 5px;
            border-bottom: 2px solid #2c5aa0;
        }

        /* Footer styles */
        .page-footer {
            margin-top: 30px;
            padding-top: 20px;
            border-top: 1px solid #e0e0e0;
            font-size: 10px;
            color: #666;
        }

        .common-notice {
            background: #f8f9fa;
            padding: 15px;
            border-radius: 4px;
            margin-bottom: 10px;
        }

        .common-notice h4 {
            color: #2c5aa0;
            margin-bottom: 10px;
        }

        .bottom-footer {
            text-align: center;
            margin-top: 15px;
            padding: 10px 0;
            border-top: 1px solid #e0e0e0;
            background-color: #000;
            color: #fff;
            border-radius: 4px;
        }
        
        .logo-img {
            height: 30px;
            max-width: 120px;
            margin-bottom: 5px;
        }

        .bottom-footer .phone {
            color: #fff;
            font-size: 12px;
        }

        /* Page breaks */
        .page-break {
            page-break-before: always;
        }

        /* Page numbers */
        .page-number {
            text-align: center;
            font-size: 10px;
            color: #999;
            margin-top: 10px;
        }

        /* Import remaining styles from master.blade.php */
        .fuel-type {
            background: rgba(255, 255, 255, 0.2);
            padding: 4px 8px;
            border-radius: 4px;
            font-size: 11px;
        }

        .warranty {
            background: #28a745;
            padding: 4px 8px;
            border-radius: 4px;
            font-size: 11px;
        }

        .price-value.financed {
            color: #28a745;
        }

        .price-value.monthly {
            color: #dc3545;
        }

        .image-section {
            margin-bottom: 20px;
        }

        .main-image {
            width: 100%;
            height: 200px;
            object-fit: cover;
            border-radius: 8px;
            border: 2px solid #e0e0e0;
        }

        .characteristics-section {
            margin-bottom: 20px;
        }

        .characteristics-table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        .characteristics-table td {
            padding: 8px 12px;
            border: 1px solid #ddd;
            vertical-align: top;
        }

        .characteristics-table td:first-child,
        .characteristics-table td:nth-child(3) {
            background: #f8f9fa;
            font-weight: bold;
            color: #2c5aa0;
            width: 25%;
        }

        .tech-specs {
            display: grid;
            grid-template-columns: 1fr 1fr 1fr;
            gap: 20px;
            margin-bottom: 20px;
        }

        .spec-group {
            background: #f8f9fa;
            padding: 15px;
            border-radius: 8px;
            border-left: 4px solid #2c5aa0;
        }

        .spec-title {
            font-size: 14px;
            font-weight: bold;
            color: #2c5aa0;
            margin-bottom: 10px;
        }

        .spec-item {
            display: flex;
            justify-content: space-between;
            margin-bottom: 5px;
        }

        .spec-label {
            color: #666;
            font-size: 11px;
        }

        .spec-value {
            font-weight: bold;
            color: #333;
            font-size: 11px;
        }

        .description-section {
            margin-bottom: 20px;
        }

        .description-content {
            background: #f8f9fa;
            padding: 15px;
            border-radius: 8px;
            line-height: 1.6;
            font-size: 11px;
        }

        .gallery-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 10px;
        }

        .gallery-image {
            width: 100%;
            height: 100px;
            object-fit: cover;
            border-radius: 4px;
            border: 1px solid #ddd;
        }

        .env-label {
            background: #28a745;
            color: white;
            padding: 2px 6px;
            border-radius: 4px;
            font-size: 10px;
            font-weight: bold;
        }
    </style>
    @yield('page-specific-styles')
</head>
<body>
    <!-- PAGE 1 -->
    <div class="container">
        @if(isset($page) && $page == 1)
        <!-- Header only on first page -->
        <div class="page-header">
            <div class="logo">QUADIS.es</div>
            <div class="contact-info">
                <div>¿Tienes dudas?</div>
                <div class="phone">¡Llámanos al 900 100 102!</div>
            </div>
        </div>
        @endif

        @yield('page1-content')

        <!-- Common footer notice on all pages -->
        <div class="page-footer">
            <div class="common-notice">
                <h4>Aviso legal</h4>
                <p>La información incluida en este folleto electrónico tiene un carácter meramente informativo. Ha sido generada en el momento de su descarga y está sujeta a posibles modificaciones sin previo aviso. En QUADIS nos esforzamos por garantizar que los datos, especificaciones y precios mostrados sean lo más precisos y actuales posible. No obstante, pueden producirse errores o variaciones.</p>
                <p>Para consultar la información actualizada sobre este vehículo, por favor visita: <strong>www.quadis.es</strong></p>
            </div>
            
            @if(isset($page) && $page != 1)
            <!-- Bottom footer only on pages 2 and 3 -->
            <div class="bottom-footer">
                <img src="{{ asset('storage/logo-quadis.es-blanco.png') }}" alt="QUADIS.es" class="logo-img">
                <div class="phone">¿Tienes dudas? ¡Llámanos al 900 100 102!</div>
            </div>
            @endif
            
            <div class="page-number">Página {{ $page ?? 1 }} de 3</div>
        </div>
    </div>

    @yield('additional-pages')
</body>
</html>
