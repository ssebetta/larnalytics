<?php
// src/Models/CustomEvent.php
namespace Ssebetta\Larnalytics\Models;

use Illuminate\Database\Eloquent\Model;

class CustomEvent extends Model
{
    protected $fillable = [
        'event_name',
        'event_data',
        'occurred_at',
    ];

    protected $casts = [
        'event_data' => 'array',
        'occurred_at' => 'datetime',
    ];
}
