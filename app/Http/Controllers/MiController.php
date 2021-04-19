<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use App\Post;
use App\Mi;
use App\MiIncome;
use App\MiCost;
use App\MiImg;
use App\Tag;
use App\PostReference;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\PostMi;
use App\Http\Requests\ConfirmMi;
use App\Events\ReferenceNotificationEvent;

class MiController extends Controller
{
	protected $mi;
	/**
	* 新しいコントローラインスタンスの生成
	*
	* @param  UserRepository  $users
	* @return void
	*/
	public function __construct(Mi $mi)
	{
		$this->middleware('auth')->only(['store', 'edit', 'update']);
		$this->mi = Mi::get();
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
		return view('mi.create', $param);
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @return \Illuminate\Http\Response
	 */
	public function store(PostMi $request, Response $response)
	{
		$validated = $request->validated();
		$post = '';
		DB::transaction(function() use($request, &$post, &$validated){
			$post = new Post([
				'post_type_id' => 3,
				'user_id' => Auth::id(),
			]);
			$post->save();

			$mi = new Mi([
				'title' => $validated['title'],
				'body' => $validated['body'],
				'user_id' => Auth::id(),
			]);
			$post->mi()->save($mi);

			foreach($validated['incomes'] as $key => $income){
				$num = $key + 1;
				$income = new MiIncome([
					'num' => $num,
					'name' => $income['name'],
					'amount' => $income['amount'],
					'volume' => $income['volume'], 
				]);
				$post->mi->incomes()->save($income);
			}
			foreach($validated['costs'] as $key => $cost){
				$num = $key + 1;
				$cost = new MiCost([
					'num' => $num,
					'name' => $cost['name'],
					'amount' => $cost['amount'],
					'volume' => $cost['volume'],
				]);
				$post->mi->costs()->save($cost);
			}
			if($request->has('imgs')){
				foreach($request->imgs as $key => $img){
					Storage::disk('public')->move('media/confirm/'.$img, 'media/uploads/'.$img);
					$num = $key + 1;
					$img = new MiImg([
						'num' => $num,
						'img' => $img,
					]);
					$post->mi->imgs()->save($img);
				}
			}

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

		return redirect()->route('mi.show', ['mi' => $post->mi->id]);
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function show($mi)
	{
		if(empty($mi)){
			return redirect()->route('home');
		}

		$mi = Mi::with('user')
		->where('id', $mi)
		->first();

		$post = Post::with('user', 'mi')
		->where('id', $mi->post_id)
		->first();

		if($post->trashed()){
			return view('mi.show', ['msg' => 'この投稿は削除されています']);
		}

		if(!$post){
			return redirect()->route('home');
		}

		$param = [
			'post' => $post,
		];
		return view('mi.show', $param);
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