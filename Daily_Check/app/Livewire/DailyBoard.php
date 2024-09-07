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
    public $currentSiteNames = []; // 複数のサイト名を格納する配列
    public $announcements = [];
    public $scheduledUsers = [];

    public function mount()
    {
        $this->userName = Auth::user()->name;
        Carbon::setLocale('ja');
        $this->currentDate = Carbon::now()->format('n/j') . '(' . Carbon::now()->isoFormat('ddd') . ')';
        $this->loadSiteAndAnnouncements();
    }

    public function loadSiteAndAnnouncements()
    {
        $userId = Auth::id();
        $today = Carbon::now()->format('Y-m-d');

        // 現在の日付でログインユーザーが入る予定の現場をすべて取得
        $scheduledUsers = ScheduledUser::where('user_id', $userId)
            ->whereHas('roles', function ($query) {
                $query->where('is_scheduled', 1);
            })
            ->whereHas('scheduled', function ($query) use ($today) {
                $query->where('date', $today);
            })
            ->with(['site', 'scheduled'])
            ->get();

        if ($scheduledUsers->isNotEmpty()) {
            // 複数のサイト名を配列に格納
            $this->currentSiteNames = $scheduledUsers->pluck('site.name')->unique()->toArray();

            // 過去一週間分のコメントを取得
            $oneWeekAgo = Carbon::now()->subWeek()->format('Y-m-d');
            $this->announcements = DailyReport::whereIn('site_id', $scheduledUsers->pluck('site.id'))
                ->whereHas('scheduled', function ($query) use ($oneWeekAgo, $today) {
                    $query->whereBetween('date', [$oneWeekAgo, $today]);
                })
                ->with('scheduled')
                ->get()
                ->map(function ($report) {
                    return [
                        'date' => $report->scheduled ? Carbon::parse($report->scheduled->date)->format('n/j') . '(' . Carbon::parse($report->scheduled->date)->isoFormat('ddd') . ')' : '日付不明',
                        'comment' => $report->comment,
                    ];
                })
                ->toArray();

            // 同じ現場に入る予定の他のユーザーを取得
            $this->scheduledUsers = ScheduledUser::whereIn('site_id', $scheduledUsers->pluck('site.id'))
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
            $this->currentSiteNames = ['未定'];
            $this->announcements = [['date' => '', 'comment' => '連絡事項はありません。']];
            $this->scheduledUsers = ['予定されているユーザーはいません。'];
        }
    }

    public function render()
    {
        return view('livewire.daily-board');
    }
}
