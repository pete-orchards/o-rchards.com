<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MiIncome extends Model
{
	protected $fillable = [
		'num', 'name', 'amount', 'volume',
	];
	
	public static $rules = array(
		'incomes.*.name' => 'bail|required|max:20',
		'incomes.*.amount' => 'bail|required|integer|digits_between:1,11',
		'incomes.*.volume' => [
			'bail',
			'required',
			'numeric',
			'regex:/(^\d{1,10}$)|(^\d{1,9}\.\d{1}$)|(^\d{1,8}\.\d{2}$)/'
		],
	);

	public static $messages = array(
		'incomes.*.name.required' => '項目名は必須です',
		'incomes.*.name.max' => '項目名は20文字以下にしてください',
		'incomes.*.amount.required' => '金額は必須です',
		'incomes.*.amount.integer' => '金額は整数で入力してください',
		'incomes.*.amount.digits_between' => '金額は11桁以内にしてください',
		'incomes.*.volume.required' => '数量は必須です',
		'incomes.*.volume.numeric' => '数量は数値で入力してください',
		'incomes.*.volume.regex' => '数量は小数点以下2桁まで、全体で10桁以内にしてください',
	);

	public function mi(){
		return $this->belongsTo('App\Mi');
	}

	public function subtotal(){
		return $this->amount * $this->volume;
	}

	public function number_format(){
		return  number_format($this);
	}
	public function format(){
		$str = (string) $this;
		return  rtrim(rtrim(number_format($str,   10), '0'),'.');
	}

}
