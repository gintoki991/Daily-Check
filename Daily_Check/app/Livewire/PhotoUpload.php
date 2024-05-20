<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithFileUploads;
use App\Models\Photo;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Storage;


class PhotoUpload extends Component
{
    use WithFileUploads;

    public $photo;
    public $part;
    public $site_id; // 外部キーとして使用
    public $scheduled_id; // 外部キーとして使用

    protected $rules = [
        'photo' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        'part' => 'nullable|string|max:255',
        'site_id' => 'nullable|integer|exists:sites,id', // 外部キーのバリデーション
        'scheduled_id' => 'nullable|integer|exists:scheduleds,id', // 外部キーのバリデーション
    ];

    public function upload()
    {
        // バリデーションの実行
        $this->validate();

        // ファイルの保存
        $path = $this->photo->store('photos', 'public');

        // データベースに保存
        $photo = new Photo();
        $photo->path = $path;
        $photo->part = $this->part;
        $photo->site_id = $this->site_id;  // FKを設定
        $photo->scheduled_id = $this->scheduled_id;  // FKを設定
        $photo->save();

        // 成功メッセージの設定
        session()->flash('success', 'Photo uploaded successfully.');
    }

    public function render()
    {
        return view('livewire.photo-upload');
    }
}
