<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Events\ReferenceNotificationEvent;
use App\Post;
use App\Mi;
use App\MiIncome;
use App\MiCost;
use App\MiImg;
use App\Tag;
use App\PostReference;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\PostMi;
use App\Http\Requests\ConfirmMi;

class MiFormController extends Controller
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
		return view('form-mi', $param);
	}

	public function confirm(ConfirmMi $request, Response $response){
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
		$param = [
			'post' => $post,
		];
		return view('confirm-mi', $param);
	}

	public function post(PostMi $request, Response $response){
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
		return redirect()->route('mi', ['id' => $post->mi->id]);
	}
}