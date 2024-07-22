<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithFileUploads;
use App\Models\Document;
use App\Models\Site;
use Illuminate\Validation\ValidationException;

class DocumentUpload extends Component
{
    use WithFileUploads;

    public $name;
    public $site_id;
    public $pdf;
    public $sites;

    public function mount()
    {
        $this->sites = Site::all();
    }

    protected $rules = [
        'name' => 'required|string|max:255',
        'site_id' => 'required|integer|exists:sites,id',
        'pdf' => 'required|mimes:pdf|max:10240', // 10MBまでのPDFファイル
    ];

    public function save()
    {
        $this->validate();

        // PDFファイルを 'pdfs' ディスクに保存
        $pdfPath = $this->pdf->store('pdfs', 'public');

        Document::create([
            'name' => $this->name,
            'site_id' => $this->site_id,
            'pdf_path' => $pdfPath,
        ]);

        session()->flash('message', '書類が正常に保存されました。');
        $this->reset(['name', 'site_id', 'pdf']);
    }

    public function render()
    {
        return view('livewire.document-upload', [
            'sites' => $this->sites,
        ])->layout('daily-check.document');
    }
}
