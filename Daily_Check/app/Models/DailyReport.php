<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DailyReport extends Model
{
    use HasFactory;

    protected $fillable = [
        'start_time',
        'end_time',
        'comment',
        'person_in_charge',
        'scheduled_id',
        'site_id',
    ];

    // usersとのリレーション設定（中間テーブル使用）
    public function users()
    {
        return $this->belongsToMany(User::class, 'scheduled_user', 'scheduled_id', 'user_id')
            ->withPivot('is_scheduled', 'is_actual', 'site_id')
            ->using(ScheduledUser::class);
    }

    // siteとのリレーション設定
    public function site()
    {
        return $this->belongsTo(Site::class);
    }

    // scheduledとのリレーション設定
    public function scheduled()
    {
        return $this->belongsTo(Scheduled::class);
    }

    // 担当者とのリレーション設定
    public function personInCharge()
    {
        return $this->belongsTo(User::class, 'person_in_charge');
    }

    // 実際に参加したユーザーとのリレーション設定
    public function scheduledUser()
    {
        return $this->hasOne(ScheduledUser::class, 'scheduled_id', 'scheduled_id');
    }

    public function roles()
    {
        return $this->hasManyThrough(ScheduledUserRole::class, ScheduledUser::class, 'scheduled_id', 'scheduled_user_id', 'scheduled_id', 'id');
    }

}
