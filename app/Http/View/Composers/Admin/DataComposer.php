<?php

namespace App\Http\View\Composers\Admin;

use Illuminate\View\View;
use App\User;
use App\Post;
use App\IdeaTheme;
use App\Tag;
use App\Good;
use App\ActionLog;
use App\LogSearchWord;
use Illuminate\Support\Facades\DB;

class DataComposer
{

	public function __construct(){
		$this->idea_themes = IdeaTheme::orderBy('from', 'desc')->take(3)->get();
		$this->posts = Post::all();
		$this->users = User::all();
		$this->tags = Tag::all();
		$this->goods = Good::all();
		$this->action_logs = ActionLog::all();
		$this->log_search_words = LogSearchWord::all();
		$this->action_log_counts = DB::table('action_log_counts')->get();
		$this->log_most_view_posts = DB::table('log_most_view_posts')->get();
		$this->log_most_view_tanes = DB::table('log_most_view_tanes')->get();
		$this->log_most_view_naes = DB::table('log_most_view_naes')->get();
		$this->log_most_view_mis = DB::table('log_most_view_mis')->get();
	}

	/**
	 * データをビューと結合
	 *
	 * @param  View  $view
	 * @return void
	 */
	public function compose(View $view)
	{
		$view->with('idea_themes', $this->idea_themes)
		->with('posts', $this->posts)
		->with('users', $this->users)
		->with('tags', $this->tags)
		->with('goods', $this->goods)
		->with('action_logs', $this->action_logs)
		->with('log_search_words', $this->log_search_words)
		->with('action_log_counts', $this->action_log_counts)
		->with('log_most_view_posts', $this->log_most_view_posts)
		->with('log_most_view_tanes', $this->log_most_view_tanes)
		->with('log_most_view_naes', $this->log_most_view_naes)
		->with('log_most_view_mis', $this->log_most_view_mis);
	}
}