<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TestDate extends Model
{
    use HasFactory;
    protected $fillable = [
        'year',
        'month',
        'day',
        'date',
        'start_time',
        'end_time',
    ];
}
