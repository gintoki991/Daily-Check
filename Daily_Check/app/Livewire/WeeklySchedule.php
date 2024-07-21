<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Scheduled;
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

        $scheduled = Scheduled::where('user_id', $userId)
            ->whereBetween('date', [$startOfWeek, $endOfWeek])
            ->with('site')
            ->get()
            ->groupBy('date');

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
