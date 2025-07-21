    @if(!empty($vehicle['images']) && count($vehicle['images']) > 0)
        <div class="images-gallery">
            <h2 class="section-title">Algunas fotos del vehículo</h2>
            <div class="gallery-grid">
                @foreach($vehicle['images'] as $index => $image)
                    @if($index < 6) {{-- Limit to 6 images --}}
                        <div>
                            <img src="{{ $image }}" alt="Vehicle Image {{ $index + 1 }}" class="gallery-image">
                            <div style="text-align: center; margin-top: 5px; font-size: 10px; color: #666;">
                                {{ $vehicle['vsbWip'] ?? 'Vehicle Image' }}
                            </div>
                        </div>
                    @endif
                @endforeach
            </div>
        </div>
    @endif