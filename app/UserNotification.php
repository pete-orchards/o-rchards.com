<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class UserNotification extends Model
{
	use SoftDeletes;

	protected $fillable = [
		'user_id', 'notifiable_type', 'notifiable_id', 'received_at',
	];

	public function user(){
		return $this->belongsTo('App\User');
	}

//データベース上はモデル名ではなくテーブル名を保存(laravelのデフォルトと異なる)
//そのためApp\AppServiceProviderのbootにmorphMapを作成
//通知タイプが増えた場合はそちらに追加すること
	public function notifiable(){
		return $this->morphTo();
	}

	public function post(){
		if($this->notifiable_type == "goods"){
			return $this->notifiable->post;
		}elseif($this->notifiable_type == "user_baskets"){
			return $this->notifiable->post;
		}elseif($this->notifiable_type == "post_references"){
			return $this->notifiable->ancestor_post;
		}
	}

	public function scopeUnreceived($query){
		return $query->where('received_at', NULL)->get();
	}

	public function isUnreceived(){
		if($this->received_at == NULL){
			return true;
		}else{
			return false;
		}
	}

}
