<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Document extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'site_id',
        'pdf_path',
    ];

    // siteとのリレーション設定
    public function site()
    {
        return $this->belongsTo(Site::class);
    }
}
