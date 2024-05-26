<?php

namespace Database\Seeders;

use App\Models\Article;
use Illuminate\Database\Seeder;

class ArticleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($i = 1; $i <= 50; $i++) {

            Article::create([
                'title' => 'タイトル ' . $i,
                'content' => "本文\n本文\n本文\n本文\n本文 " . $i
            ]);
        }
    }
}
