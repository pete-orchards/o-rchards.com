<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Post;
use App\Tane;
use App\Nae;
use App\Mi;

class IndexController extends Controller
{
	public function index(){
		$posts = Post::with('tane', 'nae', 'mi', 'user')
		->orderBy('id', 'desc')
		->get();

		return view('index', ['posts' => $posts]);
	}
}