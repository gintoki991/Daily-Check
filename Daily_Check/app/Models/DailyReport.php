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

    // 担当者とのリレーション設定
    public function personInCharge()
    {
        return $this->belongsTo(User::class, 'person_in_charge');
    }

    // Scheduledとのリレーション設定
    public function scheduled()
    {
        return $this->belongsTo(Scheduled::class);
    }

    // Siteとのリレーション設定
    public function site()
    {
        return $this->belongsTo(Site::class);
    }

    // 実際に参加したユーザー（ScheduledUserRoleを通じて取得）
    public function actualUsers()
    {
        return $this->hasManyThrough(User::class, ScheduledUser::class, 'scheduled_id', 'id', 'scheduled_id', 'user_id')
            ->join('scheduled_user_roles', 'scheduled_user_roles.scheduled_user_id', '=', 'scheduled_user.id')
            ->where('scheduled_user_roles.is_actual', true);
    }

    // DailyReportUserRoleとの新しいリレーション設定
    public function dailyReportUserRoles()
    {
        return $this->hasMany(DailyReportUserRole::class, 'daily_report_id');
    }
}
