<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Crypt;

class ActionLog extends Model
{
	const UPDATED_AT = null;

	/**
	 * ログの接続を分ける場合(参照元での設定)　https://qiita.com/nobu-maple/items/88bd6620d98bb38413bc
	protected $connection;
	public function __construct(array $attributes = []) {
		parent::__construct($attributes);
		$connection = env('DB_LOG_CONNECTION', env('DB_CONNECTION', 'mysql'));
	}
	**/

	// カラム暗号化 - 要求内容は暗号化して保存する
	public function setMessageAttribute($value)
	{
		if ($value) {
			$this->attributes['message'] = Crypt::encrypt( serialize($value) );
		}
	}
	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = [
		'user_id',
		'route',
		'url',
		'method',
		'status',
		'message',
		'remote_addr',
		'user_agent',
	];

	/**
	 * The attributes that should be hidden for arrays.
	 *
	 * @var array
	 */
	protected $hidden = [
	];

	public function user(){
		return $this->belongsTo('App\User');
	}

}
