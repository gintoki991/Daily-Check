<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'belong_to',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
        'daily_report_id',
        'site_id',
    ];

    // リレーション設定
    public function scheduleds()
    {
        return $this->hasMany(Scheduled::class);
    }

    public function daily_reports()
    {
        return $this->hasMany(DailyReport::class);
    }

    // DailyReportとのリレーション設定（中間テーブル使用）
    public function dailyReports()
    {
        return $this->belongsToMany(DailyReport::class, 'daily_report_users', 'user_id', 'daily_report_id')
            ->withPivot('is_scheduled', 'is_actual', 'site_id')
            ->using(DailyReportUser::class);
    }

    // sitesとのリレーション設定（中間テーブル使用）
    public function sites()
    {
        return $this->belongsToMany(Site::class, 'sites_users', 'user_id', 'site_id');
    }

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];
}
