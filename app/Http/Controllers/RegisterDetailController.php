<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\User;
use App\UserDetail;
use App\UserNotificationConfig;
use Illuminate\Support\Facades\Auth;

class RegisterDetailController extends Controller
{
	public function __invoke(){
		$detail = new UserDetail();
		$user = Auth::user();
		$user->detail()->save($detail);

		$notification_config = new UserNotificationConfig;
		$user->notification_config()->save($notification_config);

		return redirect()->route('home');
	}
}
