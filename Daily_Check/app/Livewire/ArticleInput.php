<?php

namespace App\Livewire;

use App\Models\Article;
use Livewire\Component;

class ArticleInput extends Component
{
    protected $listeners = [
        'create' => 'create',
        'edit' => 'edit'
    ];

    protected $rules = [ // ここがないと wire:model に反映されない
        'article.title' => ['required'],
        'article.content' => ['required'],
    ];

    public $article;

    public function render()
    {
        return view('livewire.article-input');
    }

    public function mount()
    {
        $this->create();
    }

    public function create()
    {
        $this->article = new Article();
    }

    public function edit(Article $article)
    {
        $this->article = $article;
    }

    public function save()
    {
        $this->validate();
        $this->article->save();

        session()->flash('status', '保存が完了しました。');
        $this->emitTo('article-list', 'refresh');
        $this->create();
    }
}
