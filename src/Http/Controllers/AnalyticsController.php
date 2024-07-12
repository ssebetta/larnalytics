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
        $pageViews = PageView::orderByDesc('id')->simplePaginate(15);
        $totalPageViews = PageView::count();
        return view('larnalytics::page_views', compact('pageViews', 'totalPageViews'));
    }

    public function showCustomEvents()
    {
        $customEvents = CustomEvent::simplePaginate(15);
        return view('larnalytics::custom_events', compact('customEvents'));
    }
}
