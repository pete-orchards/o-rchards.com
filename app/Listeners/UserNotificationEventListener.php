<?php

namespace App\Listeners;

use App\Events\UserNotificationEvent;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use App\User;
use App\UserNotification;
use App\UserBasket;
use App\Good;
use Log;

class UserNotificationEventListener
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  UserNotificationEvent  $event
     * @return void
     */
    public function handle(UserNotificationEvent $event)
    {
        Log::debug($event->user_id);
        Log::debug($event->notifiable_type);
        Log::debug($event->notifiable_id);
    }
}
