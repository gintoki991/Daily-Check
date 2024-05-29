<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Site;

class SiteList extends Component
{
    public $sites;

    public function mount()
    {
        $this->sites = Site::all();
    }

    public function render()
    {
        return view('livewire.site-list');
    }
}
