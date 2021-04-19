<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;
class DemoController extends Controller
{
	public function index($item = NULL, $id = NULL){
		$posts['tane'] = Post::has('tane')
		->first();
		$posts['nae'] = Post::has('nae')
		->first();
		$posts['mi'] = Post::has('mi')
		->first();

		$param = [
			'posts' => $posts,
		];

		return view('css-test', $param);
	}
}
