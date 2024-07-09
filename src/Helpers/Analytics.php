<?php
// src/Helpers/Analytics.php
namespace Ssebetta\Larnalytics\Helpers;

use Illuminate\Support\Carbon;
use Ssebetta\Larnalytics\Models\CustomEvent;

class Analytics
{
    public static function logEvent($eventName, $eventData = [])
    {
        CustomEvent::create([
            'event_name' => $eventName,
            'event_data' => $eventData,
            'occurred_at' => Carbon::now(),
        ]);
    }
}

