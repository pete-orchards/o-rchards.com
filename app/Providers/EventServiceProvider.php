<?php

namespace App\Providers;

use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Event;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        Registered::class => [
            SendEmailVerificationNotification::class,
        ],
        'App\Events\UserNotificationEvent' => [
            'App\Listeners\UserNotificationEventListener',
        ],
        'App\Events\GoodNotificationEvent' => [
            'App\Listeners\GoodNotificationEventListener',
        ],
        'App\Events\UserBasketNotificationEvent' => [
            'App\Listeners\UserBasketNotificationEventListener',
        ],
        'App\Events\ReferenceNotificationEvent' => [
            'App\Listeners\ReferenceNotificationEventListener',
        ],
        'App\Events\PostDeleteEvent' => [
            'App\Listeners\PostDeleteListener',
        ],
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        parent::boot();

        //
    }
}
