<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Laravel\Scout\Searchable;
use App\Post;

class PostSearchController extends Controller
{
	public function search(Request $request, Response $response){
		$post_data = $request->all();
		$keyword = $request->keyword;
		$type = implode(',', $request->type);
		console_log($type);

/*
		if(!empty($keyword)){
			$dbPostList = getPostSearch($keyword, $type);
		}else{
			$dbPostList = getPostList();
		}
*/
		if(empty($keyword)){
			$posts = Post::with('tane', 'nae', 'mi', 'user')
			->orderBy('id', 'desc')
			->get();
		}else{
			$posts = Post::whereHas($type, function($query) use($keyword){
				$query->Where('body', 'like', '%'.$keyword.'%')
				->orWhere('title', 'like', '%'.$keyword.'%');
			})
			->orderBy('id', 'desc')
			->get();
		}

		return view('index', ['posts' => $posts]);
	}
}