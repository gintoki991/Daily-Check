<div>
    <h1>Photo List</h1>
    <div>
        @foreach($photos as $photo)
        <div>
            <img src="{{ Storage::url($photo->path) }}" alt="Photo" width="150">
        </div>
        @endforeach
    </div>
</div>
