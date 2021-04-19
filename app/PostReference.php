<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PostReference extends Model
{

	public function bool(){
	}

	protected $fillable = ['ancestor_id', 'descendant_id', 'path_length'];

	public function user_notification(){
		return $this->morphOne('App\UserNotification', 'notifiable');
	}

	public function ancestor_post(){
		return $this->belongsTo('App\Post', 'ancestor_id');
	}

	public function descendant_post(){
		return $this->belongsTo('App\Post', 'descendant_id');
	}

}