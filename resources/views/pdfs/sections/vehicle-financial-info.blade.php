@if(!empty($vehicle['financialInformation']['descriptionMonthlyPayment']))
        <div class="page-break"></div>
        <div class="characteristics-section" style="padding-top: 70px;">
            <h2 class="section-title">Información de Financiación</h2>
            <div class="description-content">
                <table style="width: 100%; margin-bottom: 15px;">
                    <tr>
                        <td style="padding: 8px; border: 1px solid #ddd; background: #f8f9fa; font-weight: bold; color: #2c5aa0;">Entrada:</td>
                        <td style="padding: 8px; border: 1px solid #ddd;">{{ number_format($vehicle['financialInformation']['deposit'] ?? 0, 0, ',', '.') }}€</td>
                        <td style="padding: 8px; border: 1px solid #ddd; background: #f8f9fa; font-weight: bold; color: #2c5aa0;">Plazo:</td>
                        <td style="padding: 8px; border: 1px solid #ddd;">{{ $vehicle['financialInformation']['financingMonths'] ?? 'N/A' }} meses</td>
                    </tr>
                    <tr>
                        <td style="padding: 8px; border: 1px solid #ddd; background: #f8f9fa; font-weight: bold; color: #2c5aa0;">TIN:</td>
                        <td style="padding: 8px; border: 1px solid #ddd;">{{ $vehicle['financialInformation']['tin'] ?? 'N/A' }}%</td>
                        <td style="padding: 8px; border: 1px solid #ddd; background: #f8f9fa; font-weight: bold; color: #2c5aa0;">TAE:</td>
                        <td style="padding: 8px; border: 1px solid #ddd;">{{ $vehicle['financialInformation']['tae'] ?? 'N/A' }}%</td>
                    </tr>
                </table>

                <div style="font-size: 10px; line-height: 1.5; padding: 10px; background: #fff3cd; border-radius: 4px; border-left: 4px solid #ffc107;">
                    <strong>Condiciones de financiación:</strong><br>
                    {{ $vehicle['financialInformation']['descriptionMonthlyPayment'] }}
                </div>
            </div>
        </div>
    @endif
