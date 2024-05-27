<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithFileUploads;
use App\Models\User;
use App\Models\DailyReport;
use App\Models\Site;
use App\Models\Photo;
use Illuminate\Validation\ValidationException;

class ReportCreating extends Component
{
    use WithFileUploads;

    public $date;
    public $start_time;
    public $end_time;
    public $sites;
    public $person_in_charge;
    public $comment;
    public $user_ids = [];
    public $photos = [];
    public $part;
    public $site_id;
    public $scheduled_id;
    public $users;

    protected $rules = [
        'start_time' => 'required',
        'end_time' => 'required',
        'site_id' => 'required|integer|exists:sites,id', // 修正
        'person_in_charge' => 'required|string',
        'comment' => 'nullable|string|max:255',
        'user_ids' => 'array',
        'user_ids.*' => 'integer|exists:users,id',
        'scheduled_id' => 'required|integer|exists:scheduleds,id',
    ];

    // 子コンポーネントからデータを受け取る
    protected $listeners = [
        'dateUpdated' => 'setDate',
        'photosUpdated' => 'setPhotos',
        'partUpdated' => 'setPart',
        'siteIdUpdated' => 'setSiteId',
        'scheduledIdUpdated' => 'setScheduledId',
    ];

    public function mount()
    {
        $this->users = User::all(); // ユーザーリストを取得
        $this->sites = Site::all();
    }

    public function setDate($date)
    {
        $this->date = $date;
    }

    public function setPhotos($photos)
    {
        $this->photos = $photos;
    }

    public function setPart($part)
    {
        $this->part = $part;
    }

    public function setSiteId($site_id)
    {
        $this->site_id = $site_id;
    }

    public function setScheduledId($scheduled_id)
    {
        $this->scheduled_id = $scheduled_id;
    }

    public function store()
    {
        try {
            // フォームデータのバリデーション
            $validated = $this->validate();
        } catch (\Illuminate\Validation\ValidationException $e) {
            // バリデーション例外が発生した場合の処理
            dd($e->errors()); // エラーメッセージを表示
        }
        // バリデーションが成功した場合の処理
        dd($this); // この行が実行される

        // 選択された site_id に基づいてデータを取得する
        $site = Site::find($this->site_id);
        // 新しいレポートの作成
        $report = DailyReport::create([
            'date' => $this->date,
            'start_time' => $validated['start_time'],
            'end_time' => $validated['end_time'],
            'site_id' => $this->site_id,
            'scheduled_id' => $this->scheduled_id,
            'person_in_charge' => $validated['person_in_charge'],
            'comment' => $validated['comment'],
        ]);

        foreach ($this->photos as $photo) {
            // ファイルの保存
            $path = $photo->store('photos', 'public');
            $report->photos()->create([
                'path' => $path,
                'part' => $this->part,
                'site_id' => $this->site_id,
                'scheduled_id' => $this->scheduled_id
            ]);
        }

        // ユーザーの関連付け
        foreach ($validated['user_ids'] as $user_id) {
            $report->users()->attach($user_id, [
                'site_id' => $this->site_id,
                'is_scheduled' => true, // 例としてスケジュールされたとして追加
                'is_actual' => false, // 例として実際にはまだ未実施
            ]);
        }

        // フラッシュメッセージの設定
        session()->flash('success', '日報が正常に提出されました。');
        // フォームをリセット
        $this->reset(['date', 'start_time', 'end_time', 'person_in_charge', 'comment', 'user_ids', 'photos', 'part', 'site_id', 'scheduled_id']);
    }

    public function render()
    {
        return view('livewire.report-creating', [
            'users' => $this->users,
        ])->layout('daily-check.report-creating');
    }
}
