<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PostController extends Controller
{

	public function index(Request $request){
		$items = Post::all();
		return view('person.index', ['items' => $items]);
	}
}
