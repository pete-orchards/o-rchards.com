<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\News;

class NewsController extends Controller
{
	public function index(){
		$news = News::where('published_at', '<>', NULL)->get();

		$param = [
			'news' => $news,
		];
		return view('news', $param);
	}
}
