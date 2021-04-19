<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tane extends Model
{

	public function post(){
		return $this->belongsTo('App\Post', 'post_id');
	}

	public function user(){
		return $this->belongsTo('App\User', 'user_id');
	}

	protected $guarded = array('id', 'created_at');

	public static $rules = array(
		'title' => 'bail|required|max:30',
		'body' => 'bail|required|max:140',
	);

	public static $messages = array(
		'title.required' => 'タイトルは必須です',
		'title.max' => 'タイトルは30文字以下にしてください',
		'body.required' => '本文は必須です',
		'body.max' => '本文は140文字以下にしてください',
	);

	public function href(){
		return route('tane.show', ['tane' => $this->id]);
	}
}