<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\IdeaTheme;
use App\Http\Requests\AdminIdeaTheme;
use App\Http\Requests\UpdateAdminIdeaTheme;
use Illuminate\Support\Facades\Storage;

class IdeaThemeController extends Controller
{

	/**
	* テーマ企画インスタンス
	*/
	protected $idea_theme;

	/**
	* 新しいコントローラインスタンスの生成
	*
	* @param  UserRepository  $users
	* @return void
	*/
	public function __construct(IdeaTheme $idea_theme)
	{
		$this->idea_theme = IdeaTheme::withoutGlobalScope('public')->get();
	}

	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index()
	{
		$idea_theme = IdeaTheme::withoutGlobalScope('public')
		->orderBy('created_at', 'desc')
		->get();

		$param = [
			'idea_theme' => $idea_theme,
		];
		return view('admin.idea_theme.index', $param);
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function create()
	{
		$param = [];
		return view('admin.idea_theme.create', $param);
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @return \Illuminate\Http\Response
	 */
	public function store(AdminIdeaTheme $request)
	{
		$path = Storage::disk('public')->putfile('idea_theme', $request->file('banner'));
		$path = str_replace('idea_theme/', '', $path);

		$idea_theme = new IdeaTheme([
			'title' => $request->input('title'),
			'banner' => $path,
			'from' => $request->input('from'),
			'to' => $request->input('to'),
			'body' => $request->input('body'),
			'awards' => $request->input('awards'),
			'tag' => $request->input('tag'),
		]);
		$idea_theme->save();
		return redirect()->route('admin.idea_theme.index');
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function show($idea_theme)
	{
		$idea_theme = $this->idea_theme->find($idea_theme);
		$param = [
			'idea_theme' => $idea_theme,
		];
		return view('admin.idea_theme.show', $param);
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function edit($idea_theme)
	{
		$idea_theme = $this->idea_theme->find($idea_theme);
		$param = [
			'idea_theme' => $idea_theme,
		];
		return view('admin.idea_theme.edit', $param);
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function update(UpdateAdminIdeaTheme $request, $idea_theme)
	{
		$idea_theme = $this->idea_theme->find($idea_theme);
		$idea_theme->title = $request->title;

		if($request->hasFile('banner')){
			$path = Storage::disk('public')->putfile('idea_theme', $request->file('banner'));
			$path = str_replace('idea_theme/', '', $path);
			$idea_theme->banner = $path;
		}

		$idea_theme->from = $request->from;
		$idea_theme->to = $request->to;
		$idea_theme->body = $request->body;
		$idea_theme->awards = $request->awards;
		$idea_theme->tag = $request->tag;

		if($request->published_at == 'public'){
			$idea_theme->published_at = now();
		}elseif($request->published_at == 'hidden'){
			$idea_theme->published_at = NULL;
		}

		$idea_theme->save();

		if($request->published_at == 'public_all'){
			if(!empty($idea_theme->result_all)){
				$result = $idea_theme->result_all;
				$result->published_at = now();
				$result->save();
			}
			if(!empty($idea_theme->posts)){
				foreach($idea_theme->posts as $post){
					$idea_theme->posts()->updateExistingPivot($post->id, ['published_at' => now()]);
				}
			}
		}

		return redirect()->route('admin.idea_theme.show', ['idea_theme' => $idea_theme->id]);
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function destroy($idea_theme)
	{
		$idea_theme = $this->idea_theme->find($idea_theme);
		$idea_theme->delete();
		return redirect()->route('admin.idea_theme.index');
	}
}
