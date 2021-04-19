<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use PDO;

class LoginController extends Controller
{
	public function index(){
		if(Auth::check()){
			$user = Auth::user();
			return redirect('/');
		}else{
		return view('login');
		}
	}

	public function login(Request $request, Response $response){

		$validate_rule = [
			'user_id' => 'required|max:30',
			'password' => 'required|between:8,30|alpha_num',
		];
		$this->validate($request, $validate_rule);

		$user_id = $request->user_id;
		$password = $request->password;
		$remember = $request->remember;
		if(Auth::attempt(['user_id' => $user_id, 'password' => $password], $remember)){
			return redirect('user/'.$user_id);
		}else{
			 $msg = 'ログインに失敗しました。';
			 $param = [
			 	'msg' => $msg,
			 ];
			return view('login', $param);
		}
	}
}
