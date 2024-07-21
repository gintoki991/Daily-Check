<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithFileUploads;
use App\Models\Photo;
use App\Models\Site;
use App\Models\Scheduled;
use Illuminate\Support\Facades\Storage;

class PhotoUpload extends Component
{
    use WithFileUploads;

    public $photo;
    public $site_id;
    public $part;
    public $photo_date;
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
            'photo_date' => 'required|date',
        ]);

        $path = $this->photo->store('photos', 'public');

        // 日付に対応するScheduledレコードを取得または作成
        $scheduled = Scheduled::firstOrCreate([
            'date' => $this->photo_date,
            'site_id' => $this->site_id,
        ], [
            'user_id' => auth()->id(),
        ]);

        Photo::create([
            'path' => $path,
            'site_id' => $this->site_id,
            'scheduled_id' => $scheduled->id,
            'part' => $this->part,
        ]);

        session()->flash('message', '写真が正常にアップロードされました。');

        $this->reset(['photo', 'site_id', 'part', 'photo_date']);
    }

    public function render()
    {
        return view('livewire.photo-upload', [
            'sites' => $this->sites,
        ])->layout('daily-check.photo-upload');
    }
}
