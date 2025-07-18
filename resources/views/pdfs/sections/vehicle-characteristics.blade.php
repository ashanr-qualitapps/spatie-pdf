  <div class="characteristics-section">
        <h2 class="section-title">Características</h2>
        <table class="characteristics-table">
            <tr>
                <td>Matriculación</td>
                <td>{{ $vehicle['year'] ?? 'N/A' }}</td>
                <td>Kilómetros</td>
                <td>{{ !empty($vehicle['kilometers']) ? number_format($vehicle['kilometers'], 0, ',', '.') . ' km' : 'N/A' }}</td>
            </tr>
            <tr>
                <td>Combustible</td>
                <td>{{ $vehicle['fuel'] ?? 'N/A' }}</td>
                <td>Cambio</td>
                <td>{{ $vehicle['transmission'] ?? 'N/A' }}</td>
            </tr>
            <tr>
                <td>Tracción</td>
                <td>{{ $vehicle['driveTrain'] ?? 'N/A' }}</td>
                <td>Potencia</td>
                <td>{{ $vehicle['power'] ?? '' }}kW ({{ $vehicle['powerCV'] ?? '' }}CV)</td>
            </tr>
            <tr>
                <td>Plazas</td>
                <td>{{ $vehicle['seats'] ?? 'N/A' }}</td>
                <td>Tipo</td>
                <td>{{ $vehicle['type']['name'] ?? 'N/A' }}</td>
            </tr>
            <tr>
                <td>Color</td>
                <td>{{ $vehicle['color'] ?? 'N/A' }}</td>
                <td>Distintivo</td>
                <td>
                    @if(!empty($vehicle['environmentalLabel']))
                        <span class="env-label label-{{ strtolower($vehicle['environmentalLabel']) }}">
                            Etiqueta {{ strtoupper($vehicle['environmentalLabel']) }}
                        </span>
                    @else
                        N/A
                    @endif
                </td>
            </tr>
            <tr>
                <td>Puertas</td>
                <td>{{ $vehicle['doors'] ?? 'N/A' }}</td>
                <td>Garantía</td>
                <td>{{ $vehicle['warranty'] ?? 'N/A' }} {{ !empty($vehicle['warranty']) ? 'meses' : '' }}</td>
            </tr>
            <tr>
                <td>Carrocería</td>
                <td colspan="3">{{ $vehicle['category']['name'] ?? 'N/A' }}</td>
            </tr>
        </table>
    </div>