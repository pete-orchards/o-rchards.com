<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserDetail extends Model
{

	protected $fillable = [
		'user_id', 'prof_comment', 'prof_img', 'location', 'url', 'tel', 'birthday',
	];

	public static $rules = array(
		'prof_comment' => 'sometimes|max:255',
		'prof_img' => 'sometimes|bail|image|max:10000000',
		'location' => 'sometimes|max:50',
		'url' => 'sometimes|max:255|url',
//		'tel' => 'sometimes|regex:^0\d{9,10}$',
//		'birthday' => 'sometimes|date',
	);

	protected $hidden = [
		'tel',
	];

	public function user(){
		$user =  $this->belongsTo('App\User');
		return $user;
	}

	public function prof_path(){
		if($this->prof_img){
			$prof_path =  'storage/img/prof/'.$this->prof_img;
		}else{
			$prof_path =  'img/account.jpeg';
		}
		return $prof_path;
	}

	public $timestamps = false;
}
