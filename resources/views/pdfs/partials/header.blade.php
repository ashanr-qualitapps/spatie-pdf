<style>
    html, body {
        margin: 0;
        padding: 0;
    }
    
    .header {
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
        height: 60px; /* Fixed height for header */
        display: flex;
        align-items: center;
    }
    
    .header-content {
        width: 100%;
        padding: 0 20px;
        display: flex;
        justify-content: space-between;
        align-items: center;
    }
    
    .logo-section {
        display: flex;
        align-items: center;
    }
    
    .contact-section {
        text-align: right;
        font-size: 14px;
        line-height: 1.2;
    }
    
    .contact-section strong {
        font-weight: bold;
    }
</style>

<div class="header">
    <div class="header-content">
        <div class="logo-section">
            <img src="{{ $header_logo }}" alt="Quadis Logo" style="height: 30px;">
        </div>
        <div class="contact-section">
            ¿Tienes dudas?<br>
            <strong>¡Llámanos al 900 100 102!</strong>
        </div>
    </div>
</div>
