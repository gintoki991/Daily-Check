<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Actual extends Model
{
    use HasFactory;

    protected $fillable = [
        'scheduled_id',
        'user_id',
        'site_id'
    ];

    // scheduledとのリレーション設定
    public function scheduled()
    {
        return $this->belongsTo(Scheduled::class);
    }

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
}
