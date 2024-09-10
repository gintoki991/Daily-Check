<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithFileUploads;
use App\Models\Photo;
use App\Models\Site;
use App\Models\Scheduled;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;

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
            'photo' => 'required|image|max:10240', // 10MBまでの画像
            'site_id' => 'required|exists:sites,id',
            'part' => 'required|in:屋根,外壁,軒天',
            'photo_date' => 'required|date',
        ]);

        // ImageManagerインスタンスを作成（GDドライバーを使用）
        $manager = new ImageManager(new Driver());
        // 画像を読み込み、リサイズ
        $image = $manager->read($this->photo->getRealPath());

        // 画像をリサイズ (幅を800ピクセルに変更し、高さはアスペクト比を保持)
        $image->resize(800, null, function ($constraint) {
            $constraint->aspectRatio(); // アスペクト比を保持
            $constraint->upsize(); // 画像が小さくなることを防ぐ
        });

        // 圧縮した画像を一時ファイルに保存
        $tempPath = 'photos/' . uniqid() . '.jpg';
        $image->save(storage_path('app/public/' . $tempPath), 75); // 75%の品質で保存

        // 開発環境用
        $path = $this->photo->store('photos', 'public');

        // 日付に対応するScheduledレコードを取得または作成
        $scheduled = Scheduled::firstOrCreate([
            'date' => $this->photo_date,
        ]);

        Photo::create([
            'path' => $path,
            'site_id' => $this->site_id,
            'scheduled_id' => $scheduled->id,
            'part' => $this->part,
        ]);

        session()->flash('message', '写真がアップロードされました。');

        $this->reset(['photo', 'site_id', 'part', 'photo_date']);
    }

    public function render()
    {
        return view('livewire.photo-upload', [
            'sites' => $this->sites,
        ])->layout('daily-check.photo-upload');
    }
}
