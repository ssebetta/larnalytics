# Larnalytics

Larnalytics is a simple site analytics package for Laravel applications.

## Installation

1. Require the package using Composer:

    ```bash
    composer require ssebetta/larnalytics
    ```

2. Publish the package's configuration and migration files:

    ```bash
    php artisan vendor:publish --provider="Ssebetta\Larnalytics\Providers\LarnalyticsServiceProvider"
    ```

3. Run the migrations to create the necessary database tables:

    ```bash
    php artisan migrate
    ```

4. Register the middleware in your `app/Http/Kernel.php` file:

    ```php
    protected $middlewareGroups = [
        'web' => [
            // ...
            \Ssebetta\Larnalytics\Http\Middleware\TrackPageViews::class,
        ],
    ];
    ```

## Usage

Larnalytics will automatically track page views and store the data in the `page_views` table. You can log custom events using the `Analytics` helper:

```php
use Ssebetta\Larnalytics\Helpers\Analytics;

Analytics::logEvent('event_name', ['key' => 'value']);
