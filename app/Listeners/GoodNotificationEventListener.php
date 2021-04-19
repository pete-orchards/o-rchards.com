<?php

namespace App\Listeners;

use App\Events\GoodNotificationEvent;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\DB;
use App\User;
use App\UserNotification;
use App\Good;
use Log;
use App\Notifications\WebPushGood;
use App\Notifications\MailGood;
use Illuminate\Database\Eloquent\Builder;

class GoodNotificationEventListener
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
	 * @param  GoodNotificationEvent  $event
	 * @return void
	 */
	public function handle(GoodNotificationEvent $event)
	{
		if($event->user->id != $event->good->user_id){
			$trashed = UserNotification::onlyTrashed()
			->whereHasMorph(
				'notifiable',
				'App\Good',
			)->first();
			
			if($trashed){
				DB::transaction(function() use($trashed){
					$trashed->restore();
				}, 5);
			}else{

				DB::transaction(function() use($event){
					$user_notification = new UserNotification([
						'user_id' => $event->user->id,
						'notifiable_type' => $event->good->getTable(),
						'notifiable_id' => $event->good->id,
					]);
					$user_notification->save();
				}, 5);

				$user = $event->user;
				if($user->notification_config->push_general != NULL){
					if($user->notification_config->push_good != NULL){
						$user->notify(new WebPushGood($event->user, $event->good));
					}
				}
				if($user->notification_config->mail_general != NULL){
					if($user->notification_config->mail_good != NULL){
						$user->notify(new MailGood($event->user, $event->good));
					}
				}
			}
		}
	}
}
