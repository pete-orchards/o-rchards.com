<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MiImg extends Model
{
	protected $fillable = [
		'num', 'img',
	];

	public static $rules = array(
		'imgs.*' => 'sometimes|bail|required|image|max:10000000',
	);

	public static $messages = array(
		'imgs.*.required' => '画像は必須です',
		'imgs.*.image' => 'ファイルが画像ではありません',
		'imgs.*.max' => 'ファイルサイズは10Mb以内にしてください',
	);

	public function mi(){
		return $this->belongsTo('App\Mi');
	}

	public function img_path(){
		return 'storage/media/uploads/'.$this->img;
	}

	public function confirm_path(){
		return 'storage/media/confirm/'.$this->img;
	}
}
