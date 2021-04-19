<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use App\Post;
use App\Tane;
use App\Nae;
use App\NaeIncome;
use App\NaeCost;
use App\NaeImg;
use App\Tag;
use App\PostReference;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\PostNae;
use App\Http\Requests\ConfirmNae;
use App\Events\ReferenceNotificationEvent;
use Log;
use Illuminate\Support\Arr;

class NaeController extends Controller
{
	protected $nae;
	/**
	* 新しいコントローラインスタンスの生成
	*
	* @param  UserRepository  $users
	* @return void
	*/
	public function __construct(Nae $nae)
	{
		$this->middleware('auth')->only(['store', 'edit', 'update']);
		$this->nae = $nae;
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
		return view('nae.create', $param);
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @return \Illuminate\Http\Response
	 */
	public function store(PostNae $request, Response $response)
	{
		$validated = $request->validated();
		$post = '';
		DB::transaction(function() use($request, &$post, &$validated){
			$post = new Post([
				'post_type_id' => 2,
				'user_id' => Auth::id(),
			]);
			$post->save();

			$nae = new Nae([
				'title' => $validated['title'],
				'body' => $validated['body'],
				'user_id' => Auth::id(),
			]);
			$post->nae()->save($nae);

			foreach($validated['incomes'] as $key => $income){
				$num = $key + 1;
				$income = new NaeIncome([
					'num' => $num,
					'name' => $income['name'],
					'amount' => $income['amount'],
					'volume' => $income['volume'], 
				]);
				$post->nae->incomes()->save($income);
			}
			foreach($validated['costs'] as $key => $cost){
				$num = $key + 1;
				$cost = new NaeCost([
					'num' => $num,
					'name' => $cost['name'],
					'amount' => $cost['amount'],
					'volume' => $cost['volume'],
				]);
				$post->nae->costs()->save($cost);
			}
			if($request->has('imgs')){
				foreach($request->imgs as $key => $img){
					Storage::disk('public')->move('media/confirm/'.$img, 'media/uploads/'.$img);
					$num = $key + 1;
					$img = new NaeImg([
						'num' => $num,
						'img' => $img,
					]);
					$post->nae->imgs()->save($img);
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
		return redirect()->route('nae.show', ['nae' => $post->nae->id]);
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function show($nae)
	{
		if(empty($nae)){
			return redirect()->route('home');
		}

		$nae = Nae::with('user')
		->where('id', $nae)
		->first();

		$post = Post::with('user', 'nae')
		->where('id', $nae->post_id)
		->first();

		if($post->trashed()){
			return view('nae.show', ['msg' => 'この投稿は削除されています']);
		}

		if(!$post){
			return redirect()->route('home');
		}

		$param = [
			'post' => $post,
		];
		return view('nae.show', $param);
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function edit(Nae $nae)
	{
		$post = $nae->post;
		if($post->user->id !== Auth::id()){
			return redirect()->route('home');
		}

		$param = [
			'post' => $post,
		];
		return view('nae.edit', $param);
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function update(PostNae $request, Response $response, Nae $nae)
	{
		$validated = $request->validated();
		$post = $nae->post;
		DB::transaction(function() use($request, &$post, &$validated){
			$nae = $post->nae;
			$nae->title = $validated['title'];
			$nae->body = $validated['body'];
			$nae->save();

			foreach($validated['incomes'] as $key => $val){
				$num = $key + 1;
				$income = $nae->incomes->where('num', $num)->first();

				if($income){
					$income->name = $val['name'];
					$income->amount = $val['amount'];
					$income->volume = $val['volume'];
					if($income->isDirty()){
						$income->save();
					}
				}else{
					$income = new NaeIncome([
						'num' => $num,
						'name' => $val['name'],
						'amount' => $val['amount'],
						'volume' => $val['volume'], 
					]);
					$post->nae->incomes()->save($income);
				}
			}
			//更新内容が収入項目数が減る場合、元の項目を削除する必要がある
			if(count($validated['incomes']) < $nae->incomes->count()){
				$target = $nae->incomes->reject(function($value, $key) use($validated){
					return $value->num <= count($validated['incomes']);
				})->modelKeys();
				NaeIncome::destroy($target);
			}

			foreach($validated['costs'] as $key => $val){
				$num = $key + 1;
				$cost = $nae->costs->where('num', $num)->first();

				if($cost){
					$cost->name = $val['name'];
					$cost->amount = $val['amount'];
					$cost->volume = $val['volume'];
					if($cost->isDirty()){
						$cost->save();
					}
				}else{
					$num = $key + 1;
					$cost = new NaeCost([
						'num' => $num,
						'name' => $val['name'],
						'amount' => $val['amount'],
						'volume' => $val['volume'],
					]);
					$post->nae->costs()->save($cost);
				}
			}
			//更新内容が収入項目数が減る場合、元の項目を削除する必要がある
			if(count($validated['costs']) < $nae->costs->count()){
				$target = $nae->costs->reject(function($value, $key) use($validated){
					return $value->num <= count($validated['costs']);
				})->modelKeys();
				NaeCost::destroy($target);
			}

			if($request->filled('tags')){
				//元々タグを持っている場合
				if($post->tags->count() > 0){
					foreach($request->input('tags') as $key => $val){
						//変化ないものは終了
						if($post->tags->where('name', $val)->first()){
							continue;
						}else{
							//既存のタグの場合
							if(Tag::where('name', $val)->exists()){
								$tag = Tag::where('name', $val)->first();
								$post->tags()->attach($tag->id);
							}else{
							//タグ自体新しい場合
								$tag = new Tag([
									'name' => $val,
								]);
								$post->tags()->save($tag);
							}
						}
					}
					//タグが減る場合
					if(count($request->input('tags')) < $post->tags->count()){
				Log::info('decrease');
						[$keys, $values] = Arr::divide($request->input('tags'));
						$search = collect($values);
				Log::info($search);

						$target = $post->tags->reject(function($value, $key) use($search){
				Log::info($value->name.' : '.$search->contains($value->name));
							return $search->contains($value->name);
						})->modelKeys();
						$post->tags()->detach($target);
					}

				//元々はタグがなかった場合
				}else{
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
			}
		}, 5);

		return redirect()->route('nae.show', ['nae' => $post->nae->id]);
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function destroy($nae)
	{
		return redirect()->route('home');
	}
}