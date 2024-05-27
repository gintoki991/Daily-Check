<?php

namespace App\Livewire;

use App\Models\Article;
use Livewire\Component;
use Livewire\WithPagination;

class ArticleList extends Component
{
    use WithPagination;

    protected $listeners = [
        'refresh' => '$refresh', // 再読み込み
        'destroy' => 'destroy'
    ];

    public function render()
    {
        $articles = Article::paginate(10);

        return view('livewire.article-list', [
            'articles' => $articles,
        ]);
    }

    public function destroy(Article $article)
    {
        $article->delete();
    }
}
