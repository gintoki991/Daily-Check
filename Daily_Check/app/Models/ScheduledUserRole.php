<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ScheduledUserRole extends Model
{
  use HasFactory;

  protected $fillable = [
    'scheduled_user_id',
    'is_scheduled',
    'is_actual',
  ];

  public function scheduledUser()
  {
    return $this->belongsTo(ScheduledUser::class, 'scheduled_user_id');
  }
}
