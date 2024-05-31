<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\Pivot;

class DailyReportUser extends Pivot
{
    use HasFactory;

    protected $table = 'daily_report_user';

    protected $fillable = [
        'daily_report_id',
        'user_id',
        'is_scheduled',
        'is_actual',
        'site_id',
    ];

    // siteとのリレーション設定
    public function site()
    {
        return $this->belongsTo(Site::class);
    }

    // DailyReportとのリレーション設定
    public function dailyReport()
    {
        return $this->belongsTo(DailyReport::class, 'daily_report_id');
    }

    // Userとのリレーション設定
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
