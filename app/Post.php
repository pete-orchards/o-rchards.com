<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use App\Scopes\ScopePost;
use Illuminate\Database\Eloquent\SoftDeletes;
use Laravel\Scout\Searchable;

class Post extends Model
{

	protected $guarded = array('id', 'delete_flg');

	public static $rules = array(
		'user_id' => 'required',
	);

	use SoftDeletes;
	use Searchable;

	protected $with = ['tags', 'goods', 'baskets'];

	public function tane(){
		return $this->hasOne('App\Tane');
	}

	public function nae(){
		return $this->hasOne('App\Nae');
	}

	public function mi(){
		return $this->hasOne('App\Mi');
	}

	public function post_type(){
		return $this->belongsTo('App\PostType');
	}

	public function type_name(){
		if($this->post_type->name == 'tane'){
			return 'タネ';
		}elseif($this->post_type->name == 'nae'){
			return 'ナエ';
		}elseif($this->post_type->name == 'mi'){
			return 'ミ';
		}else{
			return NULL;
		}
	}

	public function each(){
		if($this->post_type->name == "tane"){
			return $this->tane;
		}
		if($this->post_type->name == "nae"){
			return $this->nae;
		}
		if($this->post_type->name == "mi"){
			return $this->mi;
		}
	}

	public function scopeTypeEqual($query, $str){
		return $query->whereHas('post_type', function(Builder $query) use($str){
			$query->where('name', $str);
		})->get();
	}

	public function user(){
		return $this->belongsTo('App\User');
	}

	public function descendant_references(){
		return $this->hasMany('App\PostReference', 'descendant_id');
	}

	public function ancestor_references(){
		return $this->hasMany('App\PostReference', 'ancestor_id');
	}

	public function ancestors(){
		return $this->belongsToMany('App\Post', 'post_references', 'descendant_id', 'ancestor_id')->wherePivot('path_length', '>', 0);
	}
	public function descendants(){
		return $this->belongsToMany('App\Post', 'post_references', 'ancestor_id', 'descendant_id')->wherePivot('path_length', '>', 0);
	}
	public function parent(){
		return $this->belongsToMany('App\Post', 'post_references', 'descendant_id', 'ancestor_id')->whereNull('deleted_at')->wherePivot('path_length', 1);
	}
	public function child(){
		return $this->belongsToMany('App\Post', 'post_references', 'ancestor_id', 'descendant_id')->whereNull('deleted_at')->wherePivot('path_length', 1);
	}


	public function count_ref(){
		$count_ref = $this->child->count();
		if($this->parent->count() == 1){
			$count_ref = $count_ref + 1;
		}
		return $count_ref;
	}

	public function goods(){
		return $this->hasMany('App\Good');
	}

	public function good_users(){
		return $this->belongsToMany('App\User', 'goods')
		->whereNull('goods.deleted_at')
		->withTimestamps();
	}

	public function baskets(){
		return $this->hasMany('App\UserBasket');
	}

	public function basket_users(){
		return $this->belongsToMany('App\User', 'user_baskets')
		->whereNull('user_baskets.deleted_at')
		->withTimestamps();
	}

	public function good_check($user_id){
		return $this->goods->where(
			'user_id', $user_id,
		)->first();
	}

	public function basket_check($user_id){
		return $this->baskets->where(
			'user_id', $user_id,
		)->first();
	}

	public function tags(){
		return $this->belongsToMany('App\Tag');
	}

	public function idea_theme_awarded(){
		return $this->belongsToMany('App\IdeaTheme')
		->withTimestamps()
		->using('App\IdeaThemePost')
		->withPivot('id');
	}

}