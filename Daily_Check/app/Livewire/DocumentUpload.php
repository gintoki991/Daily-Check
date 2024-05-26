<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithFileUploads;
use App\Models\Document;


class DocumentUpload extends Component
{
    use WithFileUploads;

    public $name;
    public $site_id;
    public $pdf_path;

    protected $rules = [
        'name' => 'required|string|max:255',
    //     'site_id' => 'required|exists:sites,id',
        // 'pdf_path' => 'required|file|mimes:pdf|max:10240', // 10MB以下のPDFファイル
    ];

    public function save()
    {
        $this->validate();

        // デバッグのためのデータダンプ
        dd($this);
            Document::create([
            'name' => $this->name,
            // 'site_id' => $this->site_id,
            'pdf_path' => $this->pdf_path->getClientOriginalName(), // アップロードされたファイルの名前を表示
            ]);

    }


    public function render()
    {
        return view('livewire.document-upload')->layout('daily-check.document');
    }
}
