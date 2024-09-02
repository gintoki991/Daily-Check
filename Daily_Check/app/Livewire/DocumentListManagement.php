<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Document;
use App\Models\Site;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class DocumentListManagement extends Component
{
    use WithPagination;

    public $site_id;
    public $sites;
    public $editingDocumentId = null;
    public $newDocumentTitle;
    public $confirmingDocumentDeletion = false;
    public $documentToDelete = null;

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

    public function confirmDeletion($documentId)
    {
        $this->confirmingDocumentDeletion = true;
        $this->documentToDelete = $documentId;
    }

    public function deleteDocument()
    {
        $document = Document::find($this->documentToDelete);
        if ($document) {
            // S3からも削除
            // Storage::disk('s3')->delete($document->pdf_path);

            $document->delete();
            session()->flash('message', '書類を削除しました');
        }

        $this->confirmingDocumentDeletion = false;
        $this->documentToDelete = null;

        return redirect()->route('documentListManagement');
    }

    public function editDocument($documentId)
    {
        $this->editingDocumentId = $documentId;
        $this->newDocumentTitle = Document::find($documentId)->name;
    }

    public function updateDocument()
    {
        $document = Document::find($this->editingDocumentId);
        if ($document) {
            $document->name = $this->newDocumentTitle;
            $document->save();
            $this->editingDocumentId = null;
            session()->flash('message', '書類をアップデートしました');
        }
    }

    public function render()
    {
        Log::info("Rendering with site ID: " . $this->site_id);

        $documents = Document::where('site_id', $this->site_id)
            ->paginate(10);

        Log::info("Documents count: " . $documents->count());

        return view('livewire.document-list-management', [
            'documents' => $documents,
            'sites' => $this->sites,
        ])->layout('daily-check.document_list_management');
    }
}
