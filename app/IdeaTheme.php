<?php

namespace App;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class IdeaTheme extends Model
{
	protected $fillable = [
		'title', 'banner', 'from', 'to', 'body', 'awards', 'tag',
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
		'banner' => 'bail|required|image|max:10000000',
		'from' => 'bail|required|date',
		'to' => 'bail|required|date|after:from',
		'body' => 'bail|required|max:1200',
		'awards' => 'bail|required|max:1200',
		'tag' => 'bail|required|max:100',
	);

	public static $update_rules = array(
		'title' => 'bail|required|max:191',
		'banner' => 'bail|sometimes|image|max:10000000',
		'from' => 'bail|required|date',
		'to' => 'bail|required|date|after:from',
		'body' => 'bail|required|max:1200',
		'awards' => 'bail|required|max:1200',
		'tag' => 'bail|required|max:100',
	);

	public function result(){
		return $this->hasOne('App\IdeaThemeResult');
	}

	public function posts(){
		return $this->belongsToMany('App\Post', 'idea_theme_award_posts')
		->withTimestamps()
		->using('App\IdeaThemePost')
		->withPivot('id', 'published_at', 'name');
	}

	public function result_all(){
		return $this->hasOne('App\IdeaThemeResult')->withoutGlobalScope('public');
	}

	public function posts_all(){
		return $this->belongsToMany('App\Post', 'idea_theme_award_posts')
		->withTimestamps()
		->using('App\IdeaThemePost')
		->withoutGlobalScope('public')
		->withPivot('id', 'published_at', 'name');
	}

	public function banner_path(){
		return 'storage/idea_theme/'.$this->banner;
	}

}