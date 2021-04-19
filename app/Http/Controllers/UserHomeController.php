<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use App\User;
use App\UserDetail;
use App\Post;
use App\Good;
use App\UserBasket;
use App\Http\Requests\EditUser;
use App\Http\Requests\ProfImg;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class UserHomeController extends Controller
{
	public function index(Request $request, Response $response, $user_id, $view = 'home'){
		if(empty($user_id)){
			return redirect('/');
		}elseif(!Auth::check()){
			return redirect('/');
		}elseif($user_id !== Auth::user()->user_id){
			return redirect('/');
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
			'view' => $view,
			'posts' => $posts,
			'tane_posts' => $tane_posts,
			'nae_posts' => $nae_posts,
			'mi_posts' => $mi_posts,
			'good_posts' => $good_posts,
			'basket_posts' => $basket_posts,
		];
		return view('user_home', $param);

	}

	public function save(EditUser $request, Response $response, $user_id, $view = 'edit'){
		if(empty($user_id)){
			return redirect('/');
		}elseif(!Auth::check()){
			return redirect('/');
		}elseif($user_id !== Auth::user()->user_id){
			return redirect('/');
		}

		$validated = $request->validated();
		$user = Auth::user();
		$user_detail = $user->detail;
		DB::transaction(function() use($request, &$user, &$user_detail, &$validated){
			$user->name = $validated['name'];
			$user->user_id = $validated['user_id'];
			if(!empty($validated['prof_comment'])){
				$user_detail->prof_comment = $validated['prof_comment'];
			}
			if(!empty($validated['url'])){
				$user_detail->url = $validated['url'];
			}
			if(!empty($validated['location'])){
				$user_detail->location = $validated['location'];
			}
			$user->save();
			$user_detail->save();
		}, 5);

		$param = [
			'user' => $user,
			'view' => $view,
		];

		return view('user_home', $param);
	}

	public function img(ProfImg $request, Response $response, $user_id, $view = 'prof_img'){
		if(empty($user_id)){
			return redirect('/');
		}elseif(!Auth::check()){
			return redirect('/');
		}elseif($user_id !== Auth::user()->user_id){
			return redirect('/');
		}

		$validated = $request->validated();
				$path = Storage::disk('public')->putfile('img/prof', $request->file('prof_img'));
				$path = str_replace('img/prof/', '', $path);

		$user = Auth::user();
		$user_detail = $user->detail;
		DB::transaction(function() use($request, &$user, &$user_detail, &$path){
			$user_detail->prof_img = $path;
			$user_detail->save();
		}, 5);

		$param = [
			'user' => $user,
			'view' => $view,
		];

		return view('user_home', $param);
	}

}
