<style>
    html, body {
        margin: 0;
        padding: 0;
    }
    
    .header{
    position: running(firstHeader);
    height: 30mm;                /* ≈ 10 % of A4 height           */
    width: 100%;
   /* *** NO OUTER SPACE *** */
        margin: 0;             /* remove stray margins   */
        padding: 0 15mm;       /* keep only inner L/R pad*/

        background:#000;
        color:#fff;
        display:flex;
        align-items:center;

        -webkit-print-color-adjust: exact;
        print-color-adjust: exact;
    }

    .header-content{                      /* keep your existing flex layout */
        flex: 1;
        display: flex;
        justify-content: space-between;
        align-items: center;
    }
    .logo-section {
        display: flex;
        align-items: right;
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

  @if(isset($showBlackHeader) && $showBlackHeader)
<div class="header">
    <div class="header-content">
        <div class="logo-section">
            <img src="{{ $header_logo }}" alt="Logo">
        </div>
        <div class="contact-section">
            ¿Tienes dudas?<br>
            <strong>¡Llámanos al 900 100 102!</strong>
        </div>
    </div>

</div>
@endif