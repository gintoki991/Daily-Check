<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Photo extends Model
{
    use HasFactory;
    protected $fillable = [
        'path',
        'site_id',
        'scheduled_id',
        'part',
        'name',
    ];

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
