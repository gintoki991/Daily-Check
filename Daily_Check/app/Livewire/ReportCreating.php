<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\User;
use App\Models\DailyReport;

class ReportCreating extends Component
{
    public $time;
    public $comment;
    public $person_in_charge;
    public $site_id;
    public $scheduled_id;
    public $user_ids = [];
    public $users;

    protected $rules = [
        'time' => 'required|integer',
        'comment' => 'nullable|string|max:255',
        'person_in_charge' => 'required|string',
        'site_id' => 'nullable|integer|exists:sites,id', // 外部キーのバリデーション
        'scheduled_id' => 'nullable|integer|exists:scheduleds,id', // 外部キーのバリデーション
        'user_ids' => 'array', // 配列のバリデーション
        'user_ids.*' => 'integer|exists:users,id', // 配列の各要素に対するバリデーション
    ];

    public function mount()
    {
        $this->users = User::all(); // ユーザーリストを取得
    }

    public function store()
    {
        // フォームデータのバリデーション
        $validated = $this->validate();

        // 新しいレポートの作成
        $report = DailyReport::create([
            'time' => $validated['time'],
            'comment' => $validated['comment'],
            'person_in_charge' => $validated['person_in_charge'],
            'site_id' => $validated['site_id'],
            'scheduled_id' => $validated['scheduled_id'],
        ]);

        // ユーザーの関連付け
        foreach ($validated['user_ids'] as $user_id) {
            $report->users()->attach($user_id, [
                'site_id' => $validated['site_id'],
                'is_scheduled' => true, // 例としてスケジュールされたとして追加
                'is_actual' => false, // 例として実際にはまだ未実施
            ]);
        }

         // フラッシュメッセージの設定
        session()->flash('success', 'User created successfully.');

        // フォームをリセットする場合
        // $this->reset();
    }

    public function render()
    {
        return view('livewire.report-creating');
    }
}
