<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class LogMostViewNae extends Model
{
	protected $fillable = [
		'logged_at',
		'num',
		'post_id',
	];

	public function post(){
		return $this->belongsTo('App\Post');
	}
}
