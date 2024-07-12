<?php
// src/Http/Controllers/AnalyticsController.php
namespace Ssebetta\Larnalytics\Http\Controllers;

use Carbon\Carbon;
use DateTime;
use Ssebetta\Larnalytics\Models\PageView;
use Ssebetta\Larnalytics\Models\CustomEvent;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\DB;

class AnalyticsController extends BaseController
{
    public function showPageViews()
    {
        $pageViews = PageView::orderByDesc('id')->simplePaginate(15);
        $totalPageViews = PageView::count();

        // Prepare data for charts
        $last24HoursData = $this->getChartData('hour', Carbon::now()->subDay());
        $lastWeekData = $this->getChartData('day', Carbon::now()->subWeek());
        $lastMonthData = $this->getChartData('week', Carbon::now()->subMonth());
        $lastYearData = $this->getChartData('month', Carbon::now()->subYear());
        $deviceData = $this->getDeviceData();

        return view('larnalytics::page_views', compact(
            'pageViews',
            'totalPageViews',
            'last24HoursData',
            'lastWeekData',
            'lastMonthData',
            'lastYearData',
            'deviceData'
        ));
    }

    private function getChartData($interval, $startTime)
    {
        $pageViews = PageView::where('viewed_at', '>=', $startTime)->get();
        $data = [];
        $labels = [];

        switch ($interval) {
            case 'hour':
                $pageViews = $pageViews->groupBy(function ($view) {
                    return Carbon::parse($view->viewed_at)->format('H');
                });
                $format = 'H';
                $labelFormat = 'H'; // Format for labels
                break;
            case 'day':
                $pageViews = $pageViews->groupBy(function ($view) {
                    return Carbon::parse($view->viewed_at)->format('D-d');
                });
                $format = 'D-d';
                $labelFormat = 'D-d'; // Format for labels
                break;
            case 'week':
                $pageViews = $pageViews->groupBy(function ($view) {
                    return Carbon::parse($view->viewed_at)->format('M-d');
                });
                $format = 'M-d';
                $labelFormat = 'M-d'; // Format for labels
                break;
            case 'month':
                $pageViews = $pageViews->groupBy(function ($view) {
                    return Carbon::parse($view->viewed_at)->format('M-Y');
                });
                $format = 'M-Y';
                $labelFormat = 'M-Y'; // Format for labels
                break;
            default:
                throw new \InvalidArgumentException("Invalid interval specified.");
        }

        foreach ($pageViews as $group => $views) {
            // Parse the date string using DateTime
            $parsedDate = DateTime::createFromFormat($format, $group);
            if (!$parsedDate) {
                throw new \InvalidArgumentException("Invalid date format: $group");
            }
            $labels[] = $parsedDate->format($labelFormat);
            $data[] = count($views);
        }

        return ['labels' => $labels, 'data' => $data];
    }


    private function getDeviceData()
    {
        $deviceCounts = PageView::select('device', DB::raw('count(*) as total'))
                                ->groupBy('device')
                                ->get();
        $labels = $deviceCounts->pluck('device');
        $data = $deviceCounts->pluck('total');
        return ['labels' => $labels, 'data' => $data];
    }

    public function showCustomEvents()
    {
        $customEvents = CustomEvent::simplePaginate(15);
        return view('larnalytics::custom_events', compact('customEvents'));
    }
}
