<?php

namespace App\Http\Controllers\Ajax;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Log;

class AjaxUserNotificationConfigController extends Controller
{
	public function __invoke(Request $request){
		$user = User::find($request->user_id);
		$config = $user->notification_config;
		$result = DB::transaction(function() use($request, &$config){
			if($request->status == 'off'){
				$column_name = $request->column_name;
				$config->$column_name = now();
				$config->save();
			}else{
				$column_name = $request->column_name;
				$config->$column_name = NULL;
				$config->save();
			}

			$result = $config->$column_name;

			return $result;
		}, 5);
		$data['result'] = $result;
		header("Content-Type: application/json; charset=utf-8");
		echo json_encode($data);
	}}
