<div>
    <h1>Photo List</h1>
    <div>
        @foreach($photos as $photo)
        <div>
            <img src="{{ Storage::url($photo->path) }}" alt="{{ $photo->name }}">
            <button wire:click="show({{ $photo->id }})">Show Photo</button>
        </div>
        @endforeach
    </div>
</div>
