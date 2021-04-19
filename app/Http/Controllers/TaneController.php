<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Post;
use App\Tane;
use App\PostReference;
use App\Tag;
use App\Events\ReferenceNotificationEvent;
use App\Http\Requests\PostTane;
use Log;

class TaneController extends Controller
{
	protected $tane;
	/**
	* 新しいコントローラインスタンスの生成
	*
	* @param  UserRepository  $users
	* @return void
	*/
	public function __construct(Tane $tane)
	{
		$this->middleware('auth')->only('store');
		$this->tane = Tane::get();
	}
	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index()
	{
		return redirect()->route('home');
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function create()
	{
		$param = [];
		return view('tane.create', $param);
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @return \Illuminate\Http\Response
	 */
	public function store(PostTane $request, Response $response)
	{
		$validated = $request->validated();
		$post = '';
		DB::transaction(function() use($request, &$post){
			$post = new Post([
				'post_type_id' => 1,
				'user_id' => Auth::id(),
			]);
			$post->save();

			$tane = new Tane([
				'title' => $request->input('title'),
				'body' => $request->input('body'),
				'user_id' => Auth::id(),
			]);
			$post->tane()->save($tane);

			if($request->filled('tags')){
				foreach($request->input('tags') as $key => $val){
					if(Tag::where('name', $val)->exists()){
						$tag = Tag::where('name', $val)->first();
						$post->tags()->attach($tag->id);
					}else{
						$tag = new Tag([
							'name' => $val,
						]);
						$post->tags()->save($tag);
					}
				}
			}

			if($request->filled('reference')){
				$parent = Post::with('descendant_references')
					->where('id', $request->input('reference'))
					->first();
				foreach($parent->descendant_references as $key => $ancestor){
					$reference = new PostReference([
						'ancestor_id' => $ancestor->ancestor_id,
						'path_length' => $ancestor->path_length + 1,
					]);
					$post->descendant_references()->save($reference);
					event(new ReferenceNotificationEvent($reference->ancestor_post->user, $reference));
				}
			}
			$reference = New PostReference([
				'ancestor_id' => $post->id,
				'path_length' => 0,
			]);
			$post->descendant_references()->save($reference);

			return $post;
		}, 5);

		return redirect()->route('tane.show', ['tane' => $post->tane->id]);
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function show($tane)
	{
		if(empty($tane)){
			return redirect()->route('home');
		}

		$tane = Tane::with('user')
		->where('id', $tane)
		->first();

		$post = Post::with('user', 'tane')
		->where('id', $tane->post_id)
		->first();

		if($post->trashed()){
			return view('tane.show', ['msg' => 'この投稿は削除されています']);
		}

		if(!$post){
			return redirect()->route('home');
		}

		$param = [
			'post' => $post,
		];
		return view('tane.show', $param);
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function edit($tane)
	{
		return redirect()->route('home');
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function update(Request $tane)
	{
		return redirect()->route('home');
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function destroy($tane)
	{
		return redirect()->route('home');
	}

}