<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Scheduled extends Model
{
    use HasFactory;

    protected $fillable = [
        'date',
        // 'user_id',
        // 'site_id',
    ];

     // userとのリレーション設定
    // public function user()
    // {
    //     return $this->belongsTo(User::class);
    // }
     // siteとのリレーション設定
    // public function site()
    // {
    //     return $this->belongsTo(Site::class);
    // }

    // daily_reportsとのリレーション設定
    public function daily_reports()
    {
        return $this->hasMany(DailyReport::class);
    }

    // scheduled_user中間テーブル設定
    public function users()
    {
        return $this->belongsToMany(User::class, 'scheduled_user', 'scheduled_id', 'user_id')
        ->withPivot('is_scheduled', 'is_actual', 'site_id')
        ->using(ScheduledUser::class);
    }
}
