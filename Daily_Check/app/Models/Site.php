<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Site extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        // 'user_id'
    ];

    // daily_reportsとのリレーション設定
    public function dailyReports()
    {
        return $this->hasMany(DailyReport::class);
    }

    // photosとのリレーション設定
    public function photos()
    {
        return $this->hasMany(Photo::class);
    }

    // documentsとのリレーション設定
    public function documents()
    {
        return $this->hasMany(Document::class);
    }

    // Userとの多対多リレーション（中間テーブルScheduledUser使用）
    public function users()
    {
        return $this->belongsToMany(User::class, 'scheduled_user', 'site_id', 'user_id')
        ->withPivot('scheduled_id')
        ->using(ScheduledUser::class);
    }
    // ScheduledUser （中間テーブル）とのリレーション
    public function scheduledUsers()
    {
        return $this->hasMany(ScheduledUser::class, 'site_id');
    }
}
