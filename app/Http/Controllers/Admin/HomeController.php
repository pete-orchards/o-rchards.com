<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\Auth;
use App\IdeaTheme;

class HomeController extends Controller
{
	public function index(){
		$user = Auth::user();

		$param = [
			'user' => $user,
		];
		return view('admin.home', $param);
	}
}
