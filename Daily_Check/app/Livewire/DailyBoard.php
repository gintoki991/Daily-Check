<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\DailyReport;
use App\Models\Scheduled;
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
        $scheduled = Scheduled::where('user_id', $userId)
            ->where('date', $today)
            ->with('site')
            ->first();

        if ($scheduled) {
            $this->currentSiteName = $scheduled->site->name;

            // 過去一週間分のコメントを取得
            $oneWeekAgo = Carbon::now()->subWeek()->format('Y-m-d');
            $this->announcements = DailyReport::where('site_id', $scheduled->site->id)
                ->whereHas('scheduled', function ($query) use ($oneWeekAgo, $today) {
                    $query->whereBetween('date', [$oneWeekAgo, $today]);
                })
                ->pluck('comment')
                ->toArray();

            // 同じ現場に入る予定の他のユーザーを取得
            $this->scheduledUsers = Scheduled::where('site_id', $scheduled->site->id)
                ->where('date', $today)
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
