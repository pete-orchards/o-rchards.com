<?php

namespace App;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class News extends Model
{
	protected $fillable = [
		'title', 'date', 'body',
	];
	use SoftDeletes;

	protected $dates = [
		'published_at',
	];

	protected static function boot(){
		parent::boot();
		static::addGlobalScope('public', function(Builder $builder){
			$builder->where('published_at', '<>', NULL);
		});
	}

	public static $rules = array(
		'title' => 'bail|required|max:191',
		'date' => 'bail|required|date',
		'body' => 'bail|required|max:1200',
	);
}
