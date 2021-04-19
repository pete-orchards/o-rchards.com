<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Events\UserNotification;
use Illuminate\Database\Eloquent\SoftDeletes;

class Good extends Model
{
	use SoftDeletes;

	protected $fillable = [
		'post_id', 'user_id',
	];

	public function post(){
		return $this->belongsTo('App\Post');
	}

	public function user(){
		return $this->belongsTo('App\User');
	}

	public function check($user_id){
		$result = Good::where(
			'post_id', $post_id,
			'user_id', $user_id,
		)->get();
		if($result){
			return true;
		}else{
			return false;
		}
	}

	public function scopeUserEqual($query, $user_id){
		return $query->where('user_id', $user_id)->first();
	}

	public function user_notification(){
		return $this->morphOne('App\UserNotification', 'notifiable');
	}

}