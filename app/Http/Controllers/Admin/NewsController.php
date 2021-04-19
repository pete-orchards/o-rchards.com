<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\News;
use App\Http\Requests\AdminNews;

class NewsController extends Controller
{
	protected $news;
	/**
	* 新しいコントローラインスタンスの生成
	*
	* @param  UserRepository  $users
	* @return void
	*/
	public function __construct(News $news)
	{
		$this->news = News::withoutGlobalScope('public')->get();
	}
	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index()
	{
		$news = News::withoutGlobalScope('public')
		->orderBy('created_at', 'desc')
		->get();

		$param = [
			'news' => $news,
		];
		return view('admin.news.index', $param);
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function create()
	{
		$param = [];
		return view('admin.news.create', $param);
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @return \Illuminate\Http\Response
	 */
	public function store(AdminNews $request)
	{
		$news = new News([
			'title' => $request->input('title'),
			'date' => $request->input('date'),
			'body' => $request->input('body'),
		]);
		$news->save();
		return redirect()->route('admin.news.index');
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function show($news)
	{
		$news = $this->news->find($news);
		$param = [
			'news' => $news,
		];
		return view('admin.news.show', $param);
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function edit($news)
	{
		$news = $this->news->find($news);
		$param = [
			'news' => $news,
		];
		return view('admin.news.edit', $param);
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function update(AdminNews $request, $news)
	{
		$news = $this->news->find($news);
		$news->title = $request->title;
		$news->date = $request->date;
		$news->body = $request->body;
		if($request->published_at == 'public'){
			$news->published_at = now();
		}elseif($request->published_at == 'hidden'){
			$news->published_at = NULL;
		}
		$news->save();
		return redirect()->route('admin.news.show', ['news' => $news->id]);
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function destroy($news)
	{
		$news = $this->news->find($news);
		$news->delete();
		return redirect()->route('admin.news.index');
	}
}
