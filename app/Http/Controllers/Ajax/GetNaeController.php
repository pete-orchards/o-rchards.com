<?php

namespace App\Http\Controllers\Ajax;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Post;
use App\Nae;
use App\NaeIncome;
use App\NaeCost;
use App\NaeImg;
use App\Tag;
use App\PostReference;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\ConfirmNae;
use Illuminate\Support\Facades\Storage;
use Log;
use Illuminate\Support\Collection;

class GetNaeController extends Controller
{
	/**
	 * Handle the incoming request.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @return \Illuminate\Http\Response
	 */
	public function __invoke(ConfirmNae $request)
	{
		//formにnae_idがあるのはeditの場合
		if($request->has('nae_id')){
			$post = $this->editNae($request->input('nae_id'), $request);
		}else{
			$post = $this->createNae($request);
		}
		//naeモデルのhref()メソッドで使うためidを設定
		if($request->has('nae_id')){
			$post->nae->id = $request->input('nae_id');
			return response()->json([
				'dom' => view('components.post.nae', [
					'post' => $post,
				])->render(),
				'submit' => view('components.form.hidden-submit', [
					'post' => $post,
					'method' => 'PUT',
					'route' => route('nae.update', ['nae' => $post->nae->id]),
				])->render(),
				'post' => $post,
			]);
		}else{
			$post->nae->id = 0;
			return response()->json([
				'dom' => view('components.post.nae', [
					'post' => $post,
					'confirm' => 'true'
				])->render(),
				'submit' => view('components.form.hidden-submit', [
					'post' => $post,
					'method' => 'POST',
					'route' => route('nae.store'),
				])->render(),
				'post' => $post,
			]);
		}
	}

	//新規ナエ投稿から呼ぶ場合
	public function createNae($request){
		$validated = $request->validated();
		$post = new Post([
			'post_type_id' => 2,
			'user_id' => Auth::id(),
		]);
		$post->user = Auth::user();

		$post->nae = new Nae([
			'title' => $validated['title'],
			'body' => $validated['body'],
			'user_id' => Auth::id(),
		]);
		foreach($validated['incomes'] as $key => $income){
			$num = $key + 1;
			$post->nae->incomes[] = new NaeIncome([
				'num' => $num,
				'name' => $income['name'],
				'amount' => $income['amount'],
				'volume' => $income['volume'],
			]);
		}
		foreach($validated['costs'] as $key => $cost){
			$num = $key + 1;
			$post->nae->costs[] = new NaeCost([
				'num' => $num,
				'name' => $cost['name'],
				'amount' => $cost['amount'],
				'volume' => $cost['volume'],
			]);
		}
		if($request->hasFile('imgs')){
			foreach($validated['imgs'] as $key => $img){
				$path[$key] = Storage::disk('public')->putfile('media/confirm', $request->file('imgs.'.$key));
				$path[$key] = str_replace('media/confirm/', '', $path[$key]);
				$num = $key + 1;
				$post->nae->imgs[] = new NaeImg([
					'num' => $num,
					'img' => $path[$key],
				]);
			}
		}
		if($request->filled('tags')){
			foreach($request->input('tags') as $key => $val){
				if(Tag::where('name', $val)->exists()){
					$tag = Tag::where('name', $val)->first();
					$post->tags[$key] = $tag;
				}else{
					$tag = new Tag([
						'name' => $val,
					]);
					$post->tags[$key] = $tag;
				}
			}
		}
		if($request->filled('reference')){
			$post->parent = Post::where('id', $request->input('reference'))->first();
		}
		return $post;
	}

	//ナエの編集から呼ぶ場合
	public function editNae($nae_id, $request){
		$validated = $request->validated();
		$nae = Nae::find($nae_id);
		$post = new Post([
			'post_type_id' => 2,
			'user_id' => Auth::id(),
		]);
		$post->user = Auth::user();

		$post->nae = new Nae([
			'title' => $validated['title'],
			'body' => $validated['body'],
			'user_id' => Auth::id(),
		]);
		foreach($validated['incomes'] as $key => $income){
			$num = $key + 1;
			$post->nae->incomes[] = new NaeIncome([
				'num' => $num,
				'name' => $income['name'],
				'amount' => $income['amount'],
				'volume' => $income['volume'],
			]);
		}
		foreach($validated['costs'] as $key => $cost){
			$num = $key + 1;
			$post->nae->costs[] = new NaeCost([
				'num' => $num,
				'name' => $cost['name'],
				'amount' => $cost['amount'],
				'volume' => $cost['volume'],
			]);
		}

		$post->nae->imgs = $nae->imgs;

		if($request->filled('tags')){
			foreach($request->input('tags') as $key => $val){
				if(Tag::where('name', $val)->exists()){
					$tag = Tag::where('name', $val)->first();
					$post->tags[$key] = $tag;
				}else{
					$tag = new Tag([
						'name' => $val,
					]);
					$post->tags[$key] = $tag;
				}
			}
		}
		return $post;
	}
}
