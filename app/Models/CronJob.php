<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class CronJob extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'command',
        'schedule',
        'user',
        'is_active',
        'last_run_at',
        'last_output',
        'last_status',
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'last_run_at' => 'datetime',
    ];
}
