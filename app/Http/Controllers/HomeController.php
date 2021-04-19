<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Post;
use Illuminate\Support\Facades\Auth;
use App\User;
use Illuminate\Support\Facades\Log;
use App\LogSearchWord;
use App\Jobs\StoreSearchWordsJob;

class HomeController extends Controller
{
	/**
	 * Create a new controller instance.
	 *
	 * @return void
	 */
/*
	public function __construct()
	{
		$this->middleware('auth');
	}
*/
	
	/**
	 * Show the application dashboard.
	 *
	 * @return \Illuminate\Contracts\Support\Renderable
	 */
	public function index(){
		$posts = Post::with(['tane', 'nae', 'mi', 'user'])
		->orderBy('id', 'desc')
		->simplePaginate(30);

		$tane_placeholders = [
			'あなたは何に関心がありますか？',
			'今何を考えてる？',
			'気になった投稿にアイデアを加えよう',
			'あなたのアイデアのタネはなんですか？',
		];
		$param = [
			'posts' => $posts,
			'tane_placeholders' => $tane_placeholders,
		];

		return view('home', $param);
	}

	public function search(Request $request){
		//ログ保存
		$types = [];
		$types = implode(',', array_merge($types, $request->type));
		Log::info('検索されました。キーワード: '.$request->keyword.', 指定タイプ: '.$types);

		$log_search_word = new LogSearchWord([
			'logged_at' => now(),
			'user_id' => Auth::check() ? Auth::id() : null,
			'keywords' => $request->keyword,
			'types' => $types,
			'remote_addr' => $request -> ip(),
		]);
		$log_search_word->save();
		//遅延処理しようとしたけどモデルが消えるのかうまくいかない
//		StoreSearchWordsJob::dispatch($log_search_word)->delay(now()->addSeconds(10));

		$keywords= [];
		$pre_keywords = explode(' ', $request->input('keyword'));
		foreach($pre_keywords as $val){
			$keywords = array_merge($keywords, explode('　', $val));
		}

		$tags = preg_grep('/^#/u', $keywords);
		$keywords = preg_grep('/^[^#].*$/', $keywords);
		$types = $request->type;
		$query = Post::query();

		if(!empty($keywords)){
			foreach($keywords as $keyword){
				foreach($types as $key => $type){
					$query->orWhereHas($type, function($query) use($keyword){
						$query->Where('body', 'like', '%'.$keyword.'%')
						->orWhere('title', 'like', '%'.$keyword.'%');
					});
				}
			}
		}
		if(!empty($tags)){
			if(in_array('#', $tags)){
				$query->has('tags');
			}else{
				foreach($tags as $tag){
					$tag = substr($tag, 1);
					foreach($types as $key => $type){
						$query->orWhereHas($type)->whereHas('tags', function($query) use($tag){
							$query->where('name', $tag);
						});
					}
				}
			}
		}

		if(empty($keywords)&&empty($tags)){
			foreach($types as $key => $type){
				$query->orHas($type);
			}
		}

		$posts = $query->orderBy('id', 'desc')->simplePaginate(30);
		$posts->load(['tane', 'nae', 'mi', 'user']);

		$tane_placeholders = [];
		$tane_placeholders = [
			'あなたは何に関心がありますか？',
			'今何を考えてる？',
			'気になった投稿にアイデアを加えよう',
			'あなたのアイデアのタネはなんですか？',
		];
		$request->flash();
		$param = [
			'posts' => $posts,
			'keyword' => $request->keyword,
			'tane_placeholders' => $tane_placeholders,
		];
		return view('home', $param);
	}
}
