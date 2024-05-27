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
        'user_ids',
        'users',
    ];

    // usersとのリレーション設定（中間テーブル使用）
    public function users()
    {
        return $this->belongsToMany(User::class, 'daily_report_users', 'daily_report_id', 'user_id')
            ->withPivot('is_scheduled', 'is_actual', 'site_id')
            ->using(DailyReportUser::class);
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
}
