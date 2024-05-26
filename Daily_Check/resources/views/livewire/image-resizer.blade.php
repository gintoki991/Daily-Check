<div>
    <button wire:click="resizeImage">Resize Image</button>

    @if ($message)
    <p>{{ $message }}</p>
    @endif

    @if ($imageExists)
    <img src="{{ asset($resizedImagePath) }}" alt="Resized Image">
    @else
    <p>Resized image does not exist.</p>
    @endif
</div>
