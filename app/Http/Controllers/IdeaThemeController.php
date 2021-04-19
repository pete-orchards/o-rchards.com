<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;
use Illuminate\Support\Facades\DB;
use App\IdeaTheme;

class IdeaThemeController extends Controller
{
	//テーマ企画のトップページを作ったら使用
	public function index(){
		if(empty($id)){
			return redirect()->route('home');
		}
	}

	public function show($id = ''){
		if(empty($id)){
			return redirect()->route('home');
		}

		$idea_theme = IdeaTheme::find($id);
		if(empty($idea_theme)){
			return redirect()->route('home');
		}

		$posts = Post::whereHas('tags', function($query) use($idea_theme){
			$query->where('name', $idea_theme->tag);
		})
		->orderBy('id', 'desc')
		->paginate(30);

		$param = [
			'idea_theme' => $idea_theme,
			'posts' => $posts
		];
		return view('idea_theme', $param);
	}
}