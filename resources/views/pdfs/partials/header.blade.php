<div style="display: flex; justify-content: space-between; align-items: center; padding: 10px 20px; border-bottom: 1px solid #ddd; background: #f8f9fa;">
    <div style="font-size: 18px; font-weight: bold; color: #2c5aa0;">QUADIS.es</div>
    <div style="font-size: 12px; color: #666;">
        <div>Vehículo: {{ $vehicle['make'] ?? '' }} {{ $vehicle['model'] ?? '' }}</div>
        <div>Ref: {{ $vehicle['vsbWip'] ?? $id ?? '' }}</div>
    </div>
</div>