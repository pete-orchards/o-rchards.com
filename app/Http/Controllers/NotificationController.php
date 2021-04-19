<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\User;
use App\Post;
use App\Good;
use App\UserBasket;
use App\PostReference;
use App\UserNotification;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class NotificationController extends Controller
{
	public function index(){
		$user = Auth::user();
		$notifications = UserNotification::where('user_id', $user->id)
		->whereHasMorph('notifiable', ['App\Good', 'App\UserBasket', 'App\PostReference'])
		->orderBy('id', 'desc')
		->paginate(30);

		$param = [
			'notifications' => $notifications,
		];
		return view('notifications', $param);
	}
}