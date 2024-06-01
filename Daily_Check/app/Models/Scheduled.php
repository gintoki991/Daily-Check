<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Scheduled extends Model
{
    use HasFactory;

    protected $fillable = [
        'date',
        'user_id',
        'site_id',
        'photo_id',
    ];

     // userとのリレーション設定
    public function user()
    {
        return $this->belongsTo(User::class);
    }
     // siteとのリレーション設定
    public function site()
    {
        return $this->belongsTo(Site::class);
    }

    // photosとのリレーション設定
    public function photos()
    {
        return $this->hasMany(Photo::class);
    }
    // daily_reportsとのリレーション設定
    public function daily_reports()
    {
        return $this->hasMany(DailyReport::class);
    }
}
