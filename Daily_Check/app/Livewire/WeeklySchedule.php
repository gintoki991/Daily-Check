<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\ScheduledUser;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class WeeklySchedule extends Component
{
    public $weeklySchedule = [];

    public function mount()
    {
        $this->loadWeeklySchedule();
    }

    public function loadWeeklySchedule()
    {
        $userId = Auth::id();
        $startOfWeek = Carbon::now()->startOfWeek();
        $endOfWeek = $startOfWeek->copy()->endOfWeek();

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

        for ($date = $startOfWeek; $date->lte($endOfWeek); $date->addDay()) {
            $dateFormatted = $date->format('Y-m-d');
            if (isset($scheduled[$dateFormatted])) {
                $this->weeklySchedule[$dateFormatted] = $scheduled[$dateFormatted]->pluck('site.name')->toArray();
            } else {
                $this->weeklySchedule[$dateFormatted] = ['未定'];
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
