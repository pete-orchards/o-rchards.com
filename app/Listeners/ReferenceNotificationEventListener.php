<?php

namespace App\Listeners;

use App\Events\ReferenceNotificationEvent;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\DB;
use App\User;
use App\UserNotification;
use App\PostReference;
use Log;
use App\Notifications\WebPushReference;
use App\Notifications\MailReference;

class ReferenceNotificationEventListener
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
	 * @param  ReferenceNotificationEvent  $event
	 * @return void
	 */
	public function handle(ReferenceNotificationEvent $event)
	{
		if($event->user->id != $event->post_reference->descendant_post->user_id){
			DB::transaction(function() use($event){
				$user_notification = new UserNotification([
					'user_id' => $event->user->id,
					'notifiable_type' => $event->post_reference->getTable(),
					'notifiable_id' => $event->post_reference->id,
				]);
				$user_notification->save();
			}, 5);

			$user = $event->user;
			if($user->notification_config->push_general != NULL){
				if($user->notification_config->push_reference != NULL){
					$user->notify(new WebPushReference($event->user, $event->post_reference));
				}
			}
			if($user->notification_config->mail_general != NULL){
				if($user->notification_config->mail_reference != NULL){
					$user->notify(new MailReference($event->user, $event->post_reference));
				}
			}
		}
	}
}
