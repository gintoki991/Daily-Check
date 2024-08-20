<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\DailyReport;
use App\Models\ScheduledUser;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class DailyBoard extends Component
{
    public $userName;
    public $currentDate;
    public $currentSiteName;
    public $announcements = [];
    public $scheduledUsers = [];

    public function mount()
    {
        $this->userName = Auth::user()->name;
        $this->currentDate = Carbon::now()->format('Y年m月d日');
        $this->loadSiteAndAnnouncements();
    }

    public function loadSiteAndAnnouncements()
    {
        $userId = Auth::id();
        $today = Carbon::now()->format('Y-m-d');

        // 現在の日付でログインユーザーが入る予定の現場を取得
        $scheduledUser = ScheduledUser::where('user_id', $userId)
            ->whereHas('roles', function ($query) { // 'roles' リレーションを利用
                $query->where('is_scheduled', 1);
            })
            ->whereHas('scheduled', function ($query) use ($today) {
                $query->where('date', $today);
            })
            ->with(['site', 'scheduled'])
            ->first();

        if ($scheduledUser) {
            $this->currentSiteName = $scheduledUser->site->name;

            // 過去一週間分のコメントを取得
            $oneWeekAgo = Carbon::now()->subWeek()->format('Y-m-d');
            $this->announcements = DailyReport::where('site_id', $scheduledUser->site->id)
                ->whereHas('scheduled', function ($query) use ($oneWeekAgo, $today) {
                    $query->whereBetween('date', [$oneWeekAgo, $today]);
                })
                ->with('scheduled') // ここでリレーションを読み込む
                ->get()
                ->map(function ($report) {
                    return [
                        'date' => $report->scheduled ? Carbon::parse($report->scheduled->date)->format('Y年m月d日') : '日付不明',
                        'comment' => $report->comment,
                    ];
                })
                ->toArray();

            // 同じ現場に入る予定の他のユーザーを取得
            $this->scheduledUsers = ScheduledUser::where('site_id', $scheduledUser->site->id)
                ->whereHas('roles', function ($query) {
                    $query->where('is_scheduled', 1);
                })
                ->whereHas('scheduled', function ($query) use ($today) {
                    $query->where('date', $today);
                })
                ->where('user_id', '!=', $userId)
                ->with('user')
                ->get()
                ->pluck('user.name')
                ->toArray();
        } else {
            $this->currentSiteName = '未定';
            $this->announcements = ['連絡事項はありません。'];
            $this->scheduledUsers = ['予定されているユーザーはいません。'];
        }
    }

    public function render()
    {
        return view('livewire.daily-board');
    }
}
