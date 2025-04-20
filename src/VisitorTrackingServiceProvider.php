<?php

namespace MonishRoy\VisitorTracking;

use Illuminate\Support\ServiceProvider;

class VisitorTrackingServiceProvider extends ServiceProvider
{
    public function boot()
    {
        $this->loadMigrationsFrom(__DIR__ . '/../database/migrations');
        $this->publishes([
            __DIR__ . '/../config/visitor-tracking.php' => config_path('visitor-tracking.php'),
        ]);
    }

    public function register()
    {
        $this->mergeConfigFrom(__DIR__ . '/../config/visitor-tracking.php', 'visitor-tracking');
    }
}
