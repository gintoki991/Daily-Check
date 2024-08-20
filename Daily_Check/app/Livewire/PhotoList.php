<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Photo;
use App\Models\Site;

class PhotoList extends Component
{
    use WithPagination;

    public $site_id;
    public $part;
    public $sites;
    public $name;

    protected $updatesQueryString = ['site_id', 'part'];

    public function mount()
    {
        $this->sites = Site::all();
        $this->site_id = request()->query('site_id', $this->site_id);
        $this->part = request()->query('part', $this->part);
        $this->updateSiteName();
    }

    public function updatedSiteId()
    {
        $this->resetPage();
        $this->updateSiteName();
    }

    public function updatedPart()
    {
        $this->resetPage();
    }

    protected function updateSiteName()
    {
        $site = $this->sites->firstWhere('id', $this->site_id);
        $this->name = $site ? $site->name : null;
    }

    public function render()
    {
        $photos = Photo::query()
            ->when($this->site_id, function ($query) {
                $query->where('site_id', $this->site_id);
            })
            ->when($this->part, function ($query) {
                $query->where('part', $this->part);
            })
            ->paginate(10);

        return view('livewire.photo-list', [
            'photos' => $photos,
            'sites' => $this->sites,
        ])->layout('daily-check.photo');
    }
}
