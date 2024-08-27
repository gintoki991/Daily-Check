<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\ScheduledUser;
use App\Models\Site;
use Carbon\Carbon;

class ScheduledDisplay extends Component
{
    public $sites;
    public $selectedDate;
    public $selectedSite;
    public $scheduledUsers = [];

    public function mount()
    {
        $this->sites = Site::all();
        $this->selectedDate = Carbon::now()->format('Y-m-d');
        $this->selectedSite = null;
        $this->loadScheduledUsers();
    }

    public function updatedSelectedDate()
    {
        $this->loadScheduledUsers();
    }

    public function selectSite($siteId)
    {
        $this->selectedSite = $siteId;
        $this->loadScheduledUsers();
    }

    public function loadScheduledUsers()
    {
        if ($this->selectedDate && $this->selectedSite) {
            $this->scheduledUsers = ScheduledUser::where('site_id', $this->selectedSite)
                ->whereHas('roles', function ($query) {
                    $query->where('is_scheduled', 1);
                })
                ->whereHas('scheduled', function ($query) {
                    $query->where('date', $this->selectedDate);
                })
                ->with('user')
                ->get()
                ->pluck('user');
        } else {
            $this->scheduledUsers = [];
        }
    }

    public function render()
    {
        return view('livewire.scheduled-display', [
            'sites' => $this->sites,
            'scheduledUsers' => $this->scheduledUsers,
        ])->layout('daily-check.');
    }
}
