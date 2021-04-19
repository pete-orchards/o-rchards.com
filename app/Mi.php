<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Mi extends Model
{
	protected $fillable = [
		'user_id', 'title', 'body',
	];

	public static $rules = array(
		'title' => 'bail|required|max:30',
		'body' => 'bail|required|max:10000',
	);

	public static $messages = array(
		'title.required' => 'タイトルは必須です',
		'title.max' => 'タイトルは30文字以下にしてください',
		'body.required' => '本文は必須です',
		'body.max' => '本文は10000文字以下にしてください',
	);

	protected $with = ['incomes', 'costs', 'imgs'];

	public function post(){
		return $this->belongsTo('App\Post', 'post_id');
	}

	public function user(){
		return $this->belongsTo('App\User', 'user_id');
	}

	public function incomes(){
		return $this->hasMany('App\MiIncome');
	}
	public function costs(){
		return $this->hasMany('App\MiCost');
	}
	public function imgs(){
		return $this->hasMany('App\MiImg');
	}

	public function income_gross(){
		$income_gross = $this->incomes->map(function($item, $key){
			return $item->subtotal();
		})->sum();
		return $income_gross;
	}

	public function cost_gross(){
		$cost_gross = $this->costs->map(function($item, $key){
			return $item->subtotal();
		})->sum();
		return $cost_gross;
	}

	public function gross(){
		$gross = $this->income_gross() - $this->cost_gross();
		return preg_replace("/\.?0+$/","" ,number_format($gross, 2));
	}

	public function href(){
		return route('mi.show', ['mi' => $this->id]);
	}

}