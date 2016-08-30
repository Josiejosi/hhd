<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Log ;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $pusher = $this->app->make('pusher');
        $pusher->set_logger( new LaravelLoggerProxy() );
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}

class LaravelLoggerProxy {
    public function log( $msg ) {
        Log::info($msg);
    }
}

