<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HelpController extends Controller
{
	public function index($item = NULL, $id = NULL){
		$helps = [
			[
				'id' => 'register',
				'title' => '会員登録',
				'description' => '会員登録の流れをご紹介します。',
				'imgs' => [
					"register_0.png",
					"register_1.png",
					"register_2.png",
					"register_3.png",
					"register_4.png",
					"register_5.png",
					"register_6.PNG",
					"register_7.PNG",
				],
			],
			[
				'id' => 'home',
				'title' => 'ホーム画面',
				'description' => 'ホーム画面でできることをご紹介します。',
				'imgs' => [
					"home_0.png",
					"home_1.png",
					"home_2.png",
					"home_3.png",
					"home_4.png",
					"home_5.png",
					"home_6.png",
					"home_7.png",
					"home_8.png",
				],
			],
			[
				'id' => 'login',
				'title' => 'ログイン',
				'description' => 'ログイン方法をご紹介します。',
				'imgs' => [
					"login_0.JPG",
					"login_1.JPG",
					"login_2.JPG",
				],
			],
		];

		$param = [
			'helps' => $helps,
		];

		return view('help', $param);
	}
}
