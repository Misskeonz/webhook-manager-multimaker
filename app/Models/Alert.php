<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\AlertRule;

class Alert extends Model
{
    use HasFactory;

    protected $fillable = [
        'alert_rule_id',
        'title',
        'message',
        'severity',
        'is_resolved',
        'resolved_at',
        'notification_sent',
    ];

    protected $casts = [
        'is_resolved' => 'boolean',
        'notification_sent' => 'boolean',
        'resolved_at' => 'datetime',
    ];

    public function alertRule()
    {
        return $this->belongsTo(AlertRule::class);
    }
}
