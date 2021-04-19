<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Jobs\StoreSearchWordsJob;

class StoreSearchWordsJobProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bindMethod(StoreSearchWordsJob::class.'@handle', function($job, $app){
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
