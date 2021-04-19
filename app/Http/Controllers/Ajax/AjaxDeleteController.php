<?php

namespace App\Http\Controllers\Ajax;

use Illuminate\Http\Request;
use App\Post;
use Illuminate\Support\Facades\DB;
use App\Events\PostDeleteEvent;
use App\Http\Controllers\Controller;

class AjaxDeleteController extends Controller
{
	public function __invoke(Request $request){
		$post = Post::find($request->post_id);
		DB::transaction(function() use($request, &$post){
			$post->delete();

			//通知先を消す必要がある
			event(new PostDeleteEvent($post));
		}, 5);
		if($post->trashed()){
			$data['ex'] = "delete";
		}else{
			$data['ex'] = "failed";
		}
		header("Content-Type: application/json; charset=utf-8");
		echo json_encode($data);
	}
}
