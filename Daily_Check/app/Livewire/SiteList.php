<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Site;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;

class SiteList extends Component
{
    public $sites;
    public $editingSite = null;
    public $confirmingSiteDeletion = false;
    public $siteToDelete;

    public $editName;

    public function mount()
    {
        $this->sites = Site::all();
    }

    public function edit($id)
    {
        $this->editingSite = Site::findOrFail($id);
        $this->editName = $this->editingSite->name;
    }

    public function save()
    {
        $this->validate([
            'editName' => 'required|string|max:255',
        ]);

        $this->editingSite->update([
            'name' => $this->editName,
        ]);

        $this->editingSite = null;
        $this->mount();  // Refresh the list
        session()->flash('message', '現場情報が更新されました。');
    }

    public function confirmDelete($id)
    {
        $this->confirmingSiteDeletion = true;
        $this->siteToDelete = Site::findOrFail($id);
    }

    public function delete()
    {
        $this->siteToDelete->delete();
        $this->confirmingSiteDeletion = false;
        $this->mount();  // Refresh the list
        session()->flash('message', '現場が削除されました。');
    }

    public function cancelDelete()
    {
        $this->confirmingSiteDeletion = false;
    }

    public function cancelEdit()
    {
        $this->editingSite = null;
    }

    public function render()
    {
        return view('livewire.site-list');
    }
}
