<?php
use Illuminate\Support\Facades\Route;
use Ssebetta\Larnalytics\Http\Controllers\AnalyticsController;

Route::get('analytics/page-views', [AnalyticsController::class, 'showPageViews'])->name('analytics.page_views');
Route::get('analytics/custom-events', [AnalyticsController::class, 'showCustomEvents'])->name('analytics.custom_events');
