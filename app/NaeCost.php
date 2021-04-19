<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class NaeCost extends Model
{
	protected $fillable = [
		'num', 'name', 'amount', 'volume',
	];

	public static $rules = array(
		'costs.*.name' => 'bail|required|max:20',
		'costs.*.amount' => 'bail|required|integer|digits_between:1,11',
		'costs.*.volume' => [
			'bail',
			'required',
			'numeric',
			'regex:/(^\d{1,10}$)|(^\d{1,9}\.\d{1}$)|(^\d{1,8}\.\d{2}$)/'
		],
	);

	public static $messages = array(
		'costs.*.name.required' => '項目名は必須です',
		'costs.*.name.max' => '項目名は20文字以下にしてください',
		'costs.*.amount.required' => '金額は必須です',
		'costs.*.amount.integer' => '金額は整数で入力してください',
		'costs.*.amount.digits_between' => '金額は11桁以内にしてください',
		'costs.*.volume.required' => '数量は必須です',
		'costs.*.volume.numeric' => '数量は数値で入力してください',
		'costs.*.volume.regex' => '数量は小数点以下2桁まで、全体で10桁以内にしてください',
	);

	public function nae(){
		return $this->belongsTo('App\Nae');
	}

	public function subtotal(){
		return $this->amount * $this->volume;
	}
	public function format(){
		$str = (string) $this;
		return  rtrim(rtrim(number_format($str,   10), '0'),'.');
	}

}