<?php

namespace App\Http\View\Composers;

use Illuminate\View\View;
use App\IdeaTheme;

class IdeaThemeComposer
{
	public function __construct(){
		$lastweek = now()->subDay(7);
		$this->idea_themes = IdeaTheme::orderBy('from', 'desc')
		->where('published_at', '<>', NULL)
		->where('to', '>', $lastweek)
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
		$view->with('idea_themes', $this->idea_themes);
	}
}