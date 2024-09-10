<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DailyReportUserRole extends Model
{
    use HasFactory;

    protected $fillable = [
        'scheduled_user_id',
        'daily_report_id',
        'is_actual',
    ];

    // ScheduledUserとのリレーション設定
    public function scheduledUser()
    {
        return $this->belongsTo(ScheduledUser::class, 'scheduled_user_id');
    }

    // DailyReportとのリレーション設定
    public function dailyReport()
    {
        return $this->belongsTo(DailyReport::class, 'daily_report_id');
    }
}
