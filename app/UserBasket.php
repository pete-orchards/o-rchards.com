<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class UserBasket extends Model
{
	use SoftDeletes;

	protected $fillable = [
		'post_id', 'user_id',
	];

	public function user(){
		return $this->belongsTo('App\User')->whereNull('deleted_at');
	}

	public function post(){
		return $this->belongsTo('App\Post')->whereNull('deleted_at');
	}

	public function user_notification(){
		return $this->morphOne('App\UserNotification', 'notifiable');
	}
}
