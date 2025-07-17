<div style="margin-top: 80px; margin-bottom: 100px; padding: 0 25px;">
    <!-- Photo Gallery Title -->
    <h2 style="font-size: 20px; font-weight: 800; margin-bottom: 30px; color: #000; text-align: center;">Alguna fotos del vehículo</h2>
    
    <!-- Photo Grid -->
    <div style="display: flex; flex-direction: column; gap: 20px; align-items: center;">
        @php
            $imageChunks = array_chunk($vehicle['images'] ?? [], 3);
        @endphp
        
        @foreach($imageChunks as $row)
            <div style="display: flex; justify-content: center; gap: 18px;">
                @foreach($row as $image)
                    <img src="{{ $image }}" alt="Vehicle Photo" style="width: 165px; height: 115px; object-fit: cover; border-radius: 8px;">
                @endforeach
            </div>
        @endforeach
    </div>
</div>
