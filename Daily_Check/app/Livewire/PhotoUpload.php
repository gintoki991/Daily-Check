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

        // 一時的にファイルを保存してパスを取得
        $temporaryPath = $this->photo->store('livewire-tmp', 'local');

        // ImageManagerインスタンスを作成（GDドライバーを使用）,version2.7.2用
        $manager = new ImageManager(['driver' => 'gd']);

        // 一時ファイルの絶対パスを取得
        $absolutePath = storage_path('app/' . $temporaryPath);

        // 画像をリサイズ
        $image = $manager->make($absolutePath)->resize(800, null, function ($constraint) {
            $constraint->aspectRatio(); // アスペクト比を保持
            $constraint->upsize(); // 画像が小さくなることを防ぐ
        });

        // 圧縮した画像を一時ファイルに保存
        $tempPath = 'photos/' . uniqid() . '.jpg';
        $image->save(storage_path('app/public/' . $tempPath), 75); // 75%の品質で保存

        // リサイズされた画像をpublicにアップロード
        $localPath = 'photos/' . uniqid() . '.jpg';
        Storage::disk('public')->put($localPath, file_get_contents(storage_path('app/public/' . $tempPath)));

        // ローカルの一時ファイルを削除
        Storage::disk('local')->delete($temporaryPath);
        Storage::disk('public')->delete($tempPath);

        // 日付に対応するScheduledレコードを取得または作成
        $scheduled = Scheduled::firstOrCreate([
            'date' => $this->photo_date,
        ]);

        Photo::create([
            'path' => $localPath,
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
