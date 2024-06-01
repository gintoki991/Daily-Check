<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\DailyReport;
use App\Models\Site;
use App\Models\Scheduled;
use Carbon\Carbon;

class ReportDisplay extends Component
{
    public $sites;
    public $selectedDate;
    public $selectedSite;
    public $reports = [];

    protected $listeners = ['dateChanged'];

    public function mount()
    {
        $this->sites = Site::all();
        $this->selectedDate = Carbon::now()->format('Y-m-d');
        $this->selectedSite = null;
    }

    public function dateChanged($date)
    {
        $this->selectedDate = $date;
        $this->loadReports();
    }

    public function selectSite($siteId)
    {
        $this->selectedSite = $siteId;
        $this->loadReports();
    }

    public function loadReports()
    {
        if ($this->selectedDate && $this->selectedSite) {
            $this->reports = DailyReport::whereHas('scheduled', function ($query) {
                $query->where('date', $this->selectedDate)
                    ->where('site_id', $this->selectedSite);
            })
                ->with('personInCharge')
                ->get();
        }
    }

    public function render()
    {
        return view('livewire.report-display', [
            'sites' => $this->sites,
            'reports' => $this->reports,
        ])->layout('daily-check.report_display');
    }
}
