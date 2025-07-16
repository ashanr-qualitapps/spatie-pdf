<!DOCTYPE html>
<html>
<head>
    <style>
        .pdf-footer {
            padding: 10px;
            font-family: Arial, sans-serif;
            font-size: 10px;
            color: #777;
            text-align: center;
            position: fixed;
            bottom: 0;
            left: 0;
            right: 0;
            height: 30px;
            background-color: white;
            border-top: 1px solid #ddd;
        }
        .footer-content {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        .page-number {
            text-align: right;
        }
        .company-info {
            text-align: left;
        }
    </style>
</head>
<body>
    <div class="pdf-footer">
        <div class="footer-content">
            <div class="company-info">
                © {{ date('Y') }} Vehicle Information System | Confidential
            </div>
            <div class="page-number">
                Page <span class="pageNumber"></span> of <span class="totalPages"></span>
            </div>
        </div>
    </div>
</body>
</html>
