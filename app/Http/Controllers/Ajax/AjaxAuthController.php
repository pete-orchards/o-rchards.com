<?php

namespace App\Http\Controllers\Ajax;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class AjaxAuthController extends Controller
{
	public function __invoke(){
		if(Auth::check()){
			//debug('ログイン済みユーザーです。');
			$ret['result'] = "1";
		}else{
			//debug('未ログインユーザーです。');
			$ret['result'] = "0";
		}

		header("Content-Type: application/json; charset=utf-8");
		echo json_encode($ret);
    }
}
