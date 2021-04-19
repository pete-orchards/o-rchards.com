<?php

namespace App;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\Pivot;

class IdeaThemePost extends Pivot
{

	 /**
	 * モデルと関連しているテーブル
	 *
	 * @var string
	 */
	protected $table = 'idea_theme_award_posts';

	
	/**
	 * IDの自動増加
	 *
	 * @var bool
	 */
	public $incrementing = true;

	protected $dates = [
		'published_at',
	];

	public function idea_theme(){
		return $this->belongsTo('App\IdeaTheme', 'idea_theme_id');
	}

	public function post(){
		return $this->belongsTo('App\Post', 'post_id');
	}

	protected static function boot(){
		parent::boot();
		static::addGlobalScope('public', function(Builder $builder){
			$builder->where('published_at', '<>', NULL);
		});
	}

}
