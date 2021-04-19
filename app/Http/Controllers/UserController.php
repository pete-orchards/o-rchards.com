<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\User;
use App\Post;
use App\Good;
use App\UserBasket;
use Illuminate\Support\Facades\Auth;
use Illuminate\Pagination\LengthAwarePaginator;

class UserController extends Controller
{
	public function index($user_id = ''){
		if(empty($user_id)){
			return redirect()->route('home');
		}

		$user = User::where('user_id', $user_id)
		->first();

		$posts = Post::where('user_id', $user->id)
		->orderBy('id', 'desc')
		->simplePaginate(30);
		$tane_posts = Post::where('user_id', $user->id)
		->has('tane')
		->orderBy('id', 'desc')
		->simplePaginate(30);
		$nae_posts = Post::where('user_id', $user->id)
		->has('nae')
		->orderBy('id', 'desc')
		->simplePaginate(30);
		$mi_posts = Post::where('user_id', $user->id)
		->has('mi')
		->orderBy('id', 'desc')
		->simplePaginate(30);
		$good_posts = Post::whereHas('goods', function($query) use($user){
			$query->where('user_id', $user->id);
		})
		->orderBy('id', 'desc')
		->simplePaginate(30);
		$basket_posts = Post::whereHas('baskets', function($query) use($user){
			$query->where('user_id', $user->id);
		})
		->orderBy('id', 'desc')
		->simplePaginate(30);
		$param = [
			'user' => $user,
			'posts' => $posts,
			'tane_posts' => $tane_posts,
			'nae_posts' => $nae_posts,
			'mi_posts' => $mi_posts,
			'good_posts' => $good_posts,
			'basket_posts' => $basket_posts,
		];

		return view('user', $param);
	}
}