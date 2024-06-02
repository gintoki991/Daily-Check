<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Document;
use App\Models\Site;
use Illuminate\Support\Facades\Log;

class DocumentList extends Component
{
    use WithPagination;

    public $site_id;
    public $sites;

    protected $updatesQueryString = ['site_id'];

    public function mount()
    {
        $this->sites = Site::all();
        Log::info('Sites loaded:', $this->sites->toArray());

        $this->site_id = request()->query('site_id', $this->site_id ?: ($this->sites->first()->id ?? null));
        Log::info("Initial site ID: " . $this->site_id);
    }

    public function updatedSiteId($value)
    {
        Log::info("Site ID updated in updatedSiteId method: " . $value);
        $this->resetPage();
    }

    public function render()
    {
        Log::info("Rendering with site ID: " . $this->site_id);

        $documents = Document::where('site_id', $this->site_id)
            ->paginate(10);

        Log::info("Documents count: " . $documents->count());

        return view('livewire.document-list', [
            'documents' => $documents,
            'sites' => $this->sites,
        ])->layout('daily-check.document');
    }
}
