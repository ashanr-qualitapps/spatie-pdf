    @if(!empty($vehicle['imageUrl']))
        <div class="image-section">
            <img src="{{ $vehicle['imageUrl'] }}" alt="Vehicle Image" class="main-image">
        </div>
    @elseif(!empty($vehicle['images']) && count($vehicle['images']) > 0)
        <div class="image-section">
            <img src="{{ $vehicle['images'][0] }}" alt="Vehicle Image" class="main-image">
        </div>
    @endif