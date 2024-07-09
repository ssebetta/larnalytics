<?php
namespace Ssebetta\Larnalytics\Providers;

use Illuminate\Support\ServiceProvider;

class LarnalyticsServiceProvider extends ServiceProvider
{
    public function register()
    {
        // Register middleware
        $this->app['router']->aliasMiddleware('track.page.views', \Ssebetta\Larnalytics\Http\Middleware\TrackPageViews::class);
    }

    public function boot()
    {
        // Publish package's assets, migrations, etc.
        $this->loadMigrationsFrom(__DIR__.'/../database/migrations');
        $this->publishes([
            __DIR__.'/../config/larnalytics.php' => $this->app->configPath('larnalytics.php'),
        ]);

        // Load routes and views
        $this->loadRoutesFrom(__DIR__.'/../routes/web.php');
        $this->loadViewsFrom(__DIR__.'/../resources/views', 'larnalytics');
    }
}
