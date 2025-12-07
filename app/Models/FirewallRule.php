<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class FirewallRule extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'action',
        'direction',
        'port',
        'protocol',
        'from_ip',
        'to_ip',
        'is_active',
        'is_system',
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'is_system' => 'boolean',
    ];
}
