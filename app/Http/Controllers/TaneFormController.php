<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Events\ReferenceNotificationEvent;
use App\Post;
use App\Tane;
use App\PostReference;
use App\Tag;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\PostTane;
use Log;

class TaneFormController extends Controller
{

	public function post(PostTane $request, Response $response){
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

		return redirect()->route('tane', ['id' => $post->tane->id]);
	}
}