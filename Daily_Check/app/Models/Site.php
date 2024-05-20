<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Site extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'user_id'
    ];

    // usersとのリレーション設定（中間テーブル使用）
    public function users()
    {
        return $this->belongsToMany(User::class, 'article_tags', 'article_id', 'tag_id');
    }

    // documentsとのリレーション設定
    // public function documents()
    // {
    //     return $this->hasMany(Document::class);
    // }
    // public function scheduleds()
    // {
    //     return $this->hasMany(Scheduled::class);
    // }
    // public function daily_reports()
    // {
    //     return $this->hasMany(Daily_report::class);
    // }
    // public function daily_reports_users_links()
    // {
    //     return $this->hasMany(Daily_reports_users_link::class);
    // }
    // public function photos()
    // {
    //     return $this->hasMany(Photo::class);
    // }
}
