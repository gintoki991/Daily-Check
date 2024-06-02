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

    protected $updatesQueryString = ['site_id', 'part'];

    public function mount()
    {
        $this->sites = Site::all();
        $this->site_id = request()->query('site_id', $this->site_id);
        $this->part = request()->query('part', $this->part);
    }

    public function updatedSiteId()
    {
        $this->resetPage();
    }

    public function updatedPart()
    {
        $this->resetPage();
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
