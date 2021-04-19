<?php

namespace App\Http\Controllers\Ajax;

use Illuminate\Http\Request;
use App\UserBasket;
use Illuminate\Support\Facades\DB;
use App\Events\UserBasketNotificationEvent;
use App\Http\Controllers\Controller;

class AjaxBasketController extends Controller
{
	public function __invoke(Request $request){
		$exist = UserBasket::where([
			['post_id', $request->post_id],
			['user_id', $request->user_id],
		])->exists();

		DB::transaction(function() use($request, &$exist){
			if($exist){
				$user_basket = UserBasket::where([
					['post_id', $request->post_id],
					['user_id', $request->user_id],
				])->first();
				if(!empty($user_basket->user_notification)){
					$user_basket->user_notification->delete();
				}
				$user_basket->delete();

			}else{
				$trashed = UserBasket::onlyTrashed()
				->where([
					['post_id', $request->post_id],
					['user_id', $request->user_id],
				])->first();
				if($trashed){
					$trashed->restore();
					$user = $trashed->post->user;
					event(new UserBasketNotificationEvent($user, $trashed));
				}else{
					$user_basket = new UserBasket([
						'post_id' => $request->post_id,
						'user_id' => $request->user_id,
					]);
					$user_basket->save();
					$user = $user_basket->post->user;
					event(new UserBasketNotificationEvent($user, $user_basket));
				}
			}
		}, 5);

		$data['ex'] = $exist;
		header("Content-Type: application/json; charset=utf-8");
		echo json_encode($data);
	}
}
