<?php

namespace App\Http\View\Composers;

use Illuminate\View\View;
use App\News;

class NewsComposer
{
	public function __construct(){
		$lastmonth = now()->subDay(31);
		$this->news = News::orderBy('date', 'desc')
		->where('published_at', '<>', NULL)
		->where('date', '>', $lastmonth)
		->get();
	}

	/**
	 * データをビューと結合
	 *
	 * @param  View  $view
	 * @return void
	 */
	public function compose(View $view)
	{
		$view->with('news', $this->news);
	}
}