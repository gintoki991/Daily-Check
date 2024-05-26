<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithFileUploads;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Storage;

class PhotoUpload extends Component
{
    use WithFileUploads;

    public $photos = [];
    public $part;
    public $site_id; // 外部キーとして使用
    public $scheduled_id; // 外部キーとして使用

    protected $rules = [
        'photos.*' => 'image|max:1024', // 1MB max
        'part' => 'required|string|max:255',
        'site_id' => 'required|integer',
        'scheduled_id' => 'required|integer',
    ];

    public function updatedPhotos()
    {
        $this->emit('photosUpdated', $this->photos);
    }

    public function updatedPart($value)
    {
        $this->emit('partUpdated', $value);
    }

    public function updatedSiteId($value)
    {
        $this->emit('siteIdUpdated', $value);
    }

    public function updatedScheduledId($value)
    {
        $this->emit('scheduledIdUpdated', $value);
    }

    public function upload()
    {
        $validatedData = $this->validate();

        // Do something with the uploaded photos and other data

        session()->flash('success', 'Photos uploaded successfully.');

        $this->reset(['photos', 'part', 'site_id', 'scheduled_id']);
    }

    public function render()
    {
        return view('livewire.photo-upload')->layout('daily-check.photos');
    }
}
