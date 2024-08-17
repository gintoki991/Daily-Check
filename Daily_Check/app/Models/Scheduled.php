<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Scheduled extends Model
{
    use HasFactory;

    protected $fillable = [
        'date',
    ];

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
