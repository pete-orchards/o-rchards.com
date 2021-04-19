<?php

namespace App\Http\Middleware;

use Closure;
use App\User;
use App\UserNotification;
use Illuminate\Support\Facades\Auth;

class ReceiveNotification
{
	/**
	 * Handle an incoming request.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  \Closure  $next
	 * @return mixed
	 */
	public function handle($request, Closure $next)
	{
		$user = Auth::user();
		//グッドが取り消されるなど孤立した通知データを消す
		$notifications = UserNotification::where('user_id', $user->id)
		->whereDoesntHaveMorph('notifiable', ['App\Good', 'App\UserBasket', 'App\PostReference'])
		->delete();

		$response = $next($request);
		//after処理(通知ページの画面上は未読だがDBは既読したという処理をしてしまう)
		$notifications = UserNotification::where('user_id', $user->id)
		->whereHasMorph('notifiable', ['App\Good', 'App\UserBasket', 'App\PostReference'])
		->update(['received_at' => now()]);



		return $response;
	}
}
