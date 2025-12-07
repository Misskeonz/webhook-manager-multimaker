<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\Alert;

class AlertRule extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'metric',
        'condition',
        'threshold',
        'service_name',
        'duration',
        'channel',
        'email',
        'slack_webhook',
        'is_active',
        'last_triggered_at',
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'threshold' => 'decimal:2',
        'last_triggered_at' => 'datetime',
    ];

    public function alerts()
    {
        return $this->hasMany(Alert::class);
    }
}
