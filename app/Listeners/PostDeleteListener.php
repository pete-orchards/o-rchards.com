<?php

namespace App\Listeners;

use App\Events\PostDeleteEvent;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use App\UserNotification;
use Illuminate\Support\Facades\DB;

class PostDeleteListener
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
	 * @param  PostDeleteEvent  $event
	 * @return void
	 */
	public function handle(PostDeleteEvent $event)
	{
		DB::transaction(function() use($event){
			$post = $event->post;
			if($post->has('descendant_references')){
				foreach ($post->descendant_references as $key => $reference) {
					if(!empty($reference->user_notification)){
						$reference->user_notification->delete();
						$reference->delete();
					}
				}
			}
			if($post->has('ancestor_references')){
				foreach ($post->ancestor_references as $key => $reference) {
					if(!empty($reference->user_notification)){
						$reference->user_notification->delete();
						$reference->delete();
					}
				}
			}
			if($post->has('goods')){
				foreach ($post->goods as $key => $good) {
					if(!empty($good->user_notification)){
						$good->user_notification->delete();
						$good->delete();
					}
				}
			}
			if($post->has('baskets')){
				foreach ($post->baskets as $key => $basket) {
					if(!empty($basket->user_notification)){
						$basket->user_notification->delete();
						$basket->delete();
					}
				}
			}
		}, 5);
	}
}
