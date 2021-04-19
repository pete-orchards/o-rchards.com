<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PostGood extends Model
{
	public function post(){
		return $this->belongsTo('App\Post');
	}

	public function bool($post_id, $user_id){
		$result = PostGood::where([
			['post_id', $post_id],
			['user_id', $user_id],
		])->get();
		if($result){
			return true;
		}else{
			return false;
		}
	}
}
