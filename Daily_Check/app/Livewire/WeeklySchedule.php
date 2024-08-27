<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\ScheduledUser;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class WeeklySchedule extends Component
{
    public $weeklySchedule = [];
    public $currentDate;

    public function mount()
    {
        $this->loadWeeklySchedule();
    }

    public function loadWeeklySchedule()
    {
        $userId = Auth::id();
        $startOfWeek = Carbon::now()->startOfWeek();
        $endOfWeek = $startOfWeek->copy()->endOfWeek();

        // 現在の日付を設定する
        $this->currentDate = Carbon::now()->format('n/j') . '(' . Carbon::now()->isoFormat('ddd') . ')';

        // ScheduledUserテーブルを使用してスケジュールを取得
        $scheduled = ScheduledUser::where('user_id', $userId)
            ->whereHas('roles', function ($query) {
                $query->where('is_scheduled', 1);
            })
            ->whereHas('scheduled', function ($query) use ($startOfWeek, $endOfWeek) {
                $query->whereBetween('date', [$startOfWeek, $endOfWeek]);
            })
            ->with('site', 'scheduled')
            ->get()
            ->groupBy(function ($item) {
                return $item->scheduled->date;
            });

        $this->weeklySchedule = [];

        Carbon::setLocale('ja'); // ロケール設定

        for ($date = $startOfWeek; $date->lte($endOfWeek); $date->addDay()) {
            $dateKey = $date->format('Y-m-d'); // 内部的に使用するための標準フォーマット
            $displayDate = $date->format('n/j') . '(' . $date->isoFormat('ddd') . ')'; // 表示用のフォーマット

            if (isset($scheduled[$dateKey])) {
                $this->weeklySchedule[$displayDate] = $scheduled[$dateKey]->pluck('site.name')->toArray();
            } else {
                $this->weeklySchedule[$displayDate] = ['未定'];
            }
        }
    }

    public function render()
    {
        return view('livewire.weekly-schedule', [
            'weeklySchedule' => $this->weeklySchedule,
        ])->layout('daily-check.home');
    }
}
