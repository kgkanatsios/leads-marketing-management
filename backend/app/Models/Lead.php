<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Jenssegers\Mongodb\Eloquent\Model;

class Lead extends Model
{
    use HasFactory;

    protected $casts = ['last_sync_time' => 'datetime', 'updated_at' => 'datetime', 'created_at' => 'datetime'];
    protected $guarded = ['_id', 'updated_at', 'created_at'];
}
