<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Events\ReferenceNotificationEvent;
use App\Post;
use App\Nae;
use App\NaeIncome;
use App\NaeCost;
use App\NaeImg;
use App\Tag;
use App\PostReference;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\PostNae;
use App\Http\Requests\ConfirmNae;

class NaeFormController extends Controller
{
	public function index(Request $request, Response $response){
		if($request->has('btn_back')){
			$request->flash();
		}

		$param = [
		];
		$msg[] = "";
		if($request->has('btn_back')){
			$param = ['btn_back_msg' => '※画像を使用する場合、再度選択してください'];
		}
		return view('form-nae', $param);
	}

	public function confirm(ConfirmNae $request, Response $response){
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
		$param = [
			'post' => $post,
		];
		return view('confirm-nae', $param);
	}

	public function post(PostNae $request, Response $response){
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
		return redirect()->route('nae', ['id' => $post->nae->id]);
	}
}