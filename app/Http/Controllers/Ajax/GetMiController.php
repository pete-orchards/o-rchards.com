<?php

namespace App\Http\Controllers\Ajax;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Post;
use App\Mi;
use App\MiIncome;
use App\MiCost;
use App\MiImg;
use App\Tag;
use App\PostReference;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\ConfirmMi;

class GetMiController extends Controller
{
	/**
	 * Handle the incoming request.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @return \Illuminate\Http\Response
	 */
	public function __invoke(ConfirmMi $request)
	{
		$validated = $request->validated();
		$post = new Post([
			'post_type_id' => 3,
			'user_id' => Auth::id(),
		]);

		$post->user = Auth::user();

		$post->mi = new Mi([
			'title' => $validated['title'],
			'body' => $validated['body'],
			'user_id' => Auth::id(),
		]);
		foreach($validated['incomes'] as $key => $income){
			$num = $key + 1;
			$post->mi->incomes[] = new MiIncome([
				'num' => $num,
				'name' => $income['name'],
				'amount' => $income['amount'],
				'volume' => $income['volume'],
			]);
		}
		foreach($validated['costs'] as $key => $cost){
			$num = $key + 1;
			$post->mi->costs[] = new MiCost([
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
				$post->mi->imgs[] = new MiImg([
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

		//miモデルのhref()メソッドで使うためidを設定
		$post->mi->id = 0;

		return response()->json([
			'dom' => view('components.post.mi', [
				'post' => $post,
				'confirm' => 'true'
			])->render(),
			'submit' => view('components.form.hidden-submit', [
				'post' => $post,
				'method' => 'POST',
				'route' => route('mi.store'),
			])->render(),
			'post' => $post,
		]);
	}
}
