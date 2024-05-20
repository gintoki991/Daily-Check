<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Photo;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Storage;

class PhotoView extends Component
{
    public $photos;

    public function mount()
    {
        $this->photos = Photo::all();
    }

    public function show()
    {
        $photo = Photo::findOrFail($photoId);
        $path = Storage::disk('public')->path($photo->path);

        // 画像の圧縮
        $image = Image::make($path)->resize(300, null, function ($constraint) {
            $constraint->aspectRatio();
        });

        return $image->response();
    }

    public function render()
    {
        return view('livewire.photo-view');
    }
}
