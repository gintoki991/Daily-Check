<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Photo;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;


class PhotoController extends Controller
{
    public function create()
    {
        return view('upload');
    }

    public function store(Request $request)
    {
        $request->validate([
            'photo' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $path = $request->file('photo')->store('photos', 'public');

        // データベースに保存
        $photo = new Photo();
        $photo->path = $path;
        $photo->save();

        return redirect()->back()->with('success', 'Photo uploaded successfully.');
    }

    public function show(Photo $photo)
    {
        $path = Storage::disk('public')->path($photo->path);

        // 画像の圧縮
        $image = Image::make($path)->resize(300, null, function ($constraint) {
            $constraint->aspectRatio();
        });

        return $image->response();
    }
}
