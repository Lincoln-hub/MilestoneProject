<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\services\data\Utility\MyLogger3;

class LoggingServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton('App\services\data\Utility\ILoggerService', function($app)
        {
            return new MyLogger3();
        });
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
