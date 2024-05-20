<?php

namespace App\Http\Controllers;

use App\Models\Photo;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;

class PhotoController extends Controller
{
    public function show(Photo $photo)
    {
        $path = Storage::disk('public')->path($photo->path);

        // 画像の圧縮
        $image = Image::make($path)->resize(300, null, function ($constraint) {
            $constraint->aspectRatio();
        });

        return $image->response();
    }

    public function download(Photo $photo)
    {
        return Storage::disk('public')->download($photo->path);
    }
}
