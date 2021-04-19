<?php

namespace App\Listeners;

use App\Events\UserBasketNotificationEvent;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\DB;
use App\User;
use App\UserNotification;
use App\UserBasket;
use Log;
use Illuminate\Database\Eloquent\Builder;
use App\Notifications\WebPushBasket;
use App\Notifications\MailBasket;

class UserBasketNotificationEventListener
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
	 * @param  UserBasketNotificationEvent  $event
	 * @return void
	 */
	public function handle(UserBasketNotificationEvent $event)
	{
		if($event->user->id != $event->user_basket->user_id){
			$trashed = UserNotification::onlyTrashed()
			->whereHasMorph(
				'notifiable',
				'App\UserBasket',
			)->first();
			
			if($trashed){
				DB::transaction(function() use($trashed){
					$trashed->restore();
				}, 5);
			}else{
				DB::transaction(function() use($event){
					$user_notification = new UserNotification([
						'user_id' => $event->user->id,
						'notifiable_type' => $event->user_basket->getTable(),
						'notifiable_id' => $event->user_basket->id,
					]);
					$user_notification->save();
				}, 5);

				$user = $event->user;
				if($user->notification_config->push_general != NULL){
					if($user->notification_config->push_basket != NULL){
						$user->notify(new WebPushBasket($event->user, $event->user_basket));
					}
				}
				if($user->notification_config->mail_general != NULL){
					if($user->notification_config->mail_basket != NULL){
						$user->notify(new MailBasket($event->user, $event->user_basket));
					}
				}

			}
		}
	}
}
