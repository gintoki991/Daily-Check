<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\Pivot;

class ScheduledUser extends Pivot
{
    use HasFactory;

    protected $table = 'scheduled_user';

    protected $fillable = [
        'scheduled_id',
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

    // Scheduledとのリレーション設定
    public function scheduled()
    {
        return $this->belongsTo(Scheduled::class, 'scheduled_id');
    }

    // Userとのリレーション設定
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}