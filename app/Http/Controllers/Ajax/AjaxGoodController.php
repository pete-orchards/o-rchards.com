<?php

namespace App\Http\Controllers\Ajax;

use Illuminate\Http\Request;
use App\Good;
use App\User;
use Illuminate\Support\Facades\DB;
use App\Events\GoodNotificationEvent;
use Log;
use App\Notifications\WebPushGood;
use App\Notifications\MailGood;
use App\Http\Controllers\Controller;

class AjaxGoodController extends Controller
{
	public function __invoke(Request $request){
		$exist = Good::where([
			['post_id', $request->post_id],
			['user_id', $request->user_id],
		])->exists();
		DB::transaction(function() use($request, &$exist){
			if($exist){
				$good = Good::withTrashed()
				->where([
					['post_id', $request->post_id],
					['user_id', $request->user_id],
				])->first();
				if(!empty($good->user_notification)){
					$good->user_notification->delete();
				}
				$good->delete();
			}else{
				$trashed = Good::onlyTrashed()
				->where([
					['post_id', $request->post_id],
					['user_id', $request->user_id],
				])->first();
				if($trashed){
					$trashed->restore();
					$user = $trashed->post->user;
					event(new GoodNotificationEvent($user, $trashed));
				}else{
					$good = new Good([
						'post_id' => $request->post_id,
						'user_id' => $request->user_id,
					]);
					$good->save();
					$user = $good->post->user;
					event(new GoodNotificationEvent($user, $good));
				}
			}
		}, 5);

		$data['ex'] = $exist;
		$data['count'] = Good::where('post_id', $request->post_id)->count();
		header("Content-Type: application/json; charset=utf-8");
		echo json_encode($data);
	}
}