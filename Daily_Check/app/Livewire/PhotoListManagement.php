<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Photo;
use App\Models\Site;

class PhotoListManagement extends Component
{
    use WithPagination;

    public $site_id;
    public $part;
    public $sites;
    public $editingPhotoId = null;
    public $newPhotoTitle;
    public $confirmingPhotoDeletion = false;
    public $photoToDelete = null;
    public $partOptions = ['屋根', '外壁', '軒天'];

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

    public function confirmDeletion($photoId)
    {
        $this->confirmingPhotoDeletion = true;
        $this->photoToDelete = $photoId;
    }

    public function deletePhoto()
    {
        $photo = Photo::find($this->photoToDelete);
        if ($photo) {
            $photo->delete();
            session()->flash('message', 'Photo deleted successfully.');
        }

        $this->confirmingPhotoDeletion = false;
        $this->photoToDelete = null;
    }

    public function editPhoto($photoId)
    {
        $this->editingPhotoId = $photoId;
        $this->newPhotoTitle = Photo::find($photoId)->part;
    }

    public function updatePhoto()
    {
        $this->validate([
            'newPhotoTitle' => 'required|in:屋根,外壁,軒天',
        ]);
        
        $photo = Photo::find($this->editingPhotoId);
        if ($photo) {
            $photo->part = $this->newPhotoTitle;
            $photo->save();
            $this->editingPhotoId = null;
            session()->flash('message', '写真のアップデートに成功しました');
        }
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

        return view('livewire.photo-list-management', [
            'photos' => $photos,
            'sites' => $this->sites,
        ])->layout('daily-check.photo_list_management');
    }
}
