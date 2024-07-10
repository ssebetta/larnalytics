<?php
// src/Http/Controllers/AnalyticsController.php
namespace Ssebetta\Larnalytics\Http\Controllers;

use Ssebetta\Larnalytics\Models\PageView;
use Ssebetta\Larnalytics\Models\CustomEvent;
use Illuminate\Routing\Controller as BaseController;

class AnalyticsController extends BaseController
{
    public function showPageViews()
    {
        $pageViews = PageView::all();
        return view('larnalytics::page_views', compact('pageViews'));
    }

    public function showCustomEvents()
    {
        $customEvents = CustomEvent::all();
        return view('larnalytics::custom_events', compact('customEvents'));
    }
}
