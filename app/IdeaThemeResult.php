<?php

namespace App;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class IdeaThemeResult extends Model
{
	protected $fillable = [
		'banner', 'body',
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
		'idea_theme_id' => 'bail|required|exists:App\IdeaTheme,id',
		'banner' => 'bail|required|image|max:10000000',
		'body' => 'bail|required|max:1200',
	);

	public static $update_rules = array(
		'banner' => 'bail|sometimes|image|max:10000000',
		'body' => 'bail|required|max:1200',
	);

	public function idea_theme(){
		return $this->belongsTo('App\IdeaTheme', 'idea_theme_id');
	}

	public function idea_theme_all(){
		return $this->belongsTo('App\IdeaTheme', 'idea_theme_id')->withoutGlobalScope('public');
	}

	public function banner_path(){
		return 'storage/idea_theme/'.$this->banner;
	}
}
