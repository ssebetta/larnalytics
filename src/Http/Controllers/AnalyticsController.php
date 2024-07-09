<?php
// src/Http/Controllers/AnalyticsController.php
namespace Ssebetta\Larnalytics\Http\Controllers;

use Ssebetta\Larnalytics\Models\PageView;
use Ssebetta\Larnalytics\Models\CustomEvent;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\View;

class AnalyticsController extends BaseController
{
    public function showPageViews()
    {
        $pageViews = PageView::all();
        return $this->view('larnalytics::page_views', compact('pageViews'));
    }

    public function showCustomEvents()
    {
        $customEvents = CustomEvent::all();
        return $this->view('larnalytics::custom_events', compact('customEvents'));
    }
}
