<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
	protected $fillable = [
		'name',
	];

	public static $rules = array(
		'tags.*' => 'sometimes|bail|required|max:100',
	);

	public static $messages = array(
		'tags.*.required' => '未入力です',
		'tags.*.max' => 'タグが100文字を超えています',
	);

	public function posts(){
		return $this->belongsToMany('App\Post');
	}

}
