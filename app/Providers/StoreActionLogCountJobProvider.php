<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Jobs\StoreActionLogCountJob;

class StoreActionLogCountJobProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bindMethod(StoreActionLogCountJob::class.'@handle', function($job, $app){
            return $job->handle();
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
