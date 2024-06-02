<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithFileUploads;
use App\Models\Photo;
use App\Models\Site;
use Illuminate\Support\Facades\Storage;

class PhotoUpload extends Component
{
    use WithFileUploads;

    public $photo;
    public $site_id;
    public $part;
    public $sites;

    public function mount()
    {
        $this->sites = Site::all();
    }

    public function save()
    {
        $this->validate([
            'photo' => 'required|image|max:1024', // 1MBまでの画像
            'site_id' => 'required|exists:sites,id',
            'part' => 'required|in:屋根,外壁,軒天',
        ]);

        $path = $this->photo->store('photos', 'public');

        // サムネイルの生成
        // $thumbnailPath = 'thumbnails/' . basename($path);
        // $image = \Intervention\Image\Facades\Image::make(Storage::disk('public')->path($path));
        // $image->resize(200, null, function ($constraint) {
        //     $constraint->aspectRatio();
        // })->save(Storage::disk('public')->path($thumbnailPath));

        Photo::create([
            'path' => basename($path),
            'site_id' => $this->site_id,
            'part' => $this->part,
        ]);

        session()->flash('message', '写真が正常にアップロードされました。');

        $this->reset(['photo', 'site_id', 'part']);
    }


    public function render()
    {
        return view('livewire.photo-upload', [
            'sites' => $this->sites,
        ])->layout('daily-check.photo-upload');
    }
}
