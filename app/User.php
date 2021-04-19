<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Validation\Rule;
use Illuminate\Database\Eloquent\SoftDeletes;
use NotificationChannels\WebPush\HasPushSubscriptions;
use Illuminate\Support\Collection;

class User extends Authenticatable implements MustVerifyEmail
{
	use Notifiable, HasPushSubscriptions, SoftDeletes;

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = [
		'name', 'user_id', 'email', 'password',
	];

	/**
	 * The attributes that should be hidden for arrays.
	 *
	 * @var array
	 */
	protected $hidden = [
		'password', 'remember_token', 'email',
	];

	/**
	 * The attributes that should be cast to native types.
	 *
	 * @var array
	 */
	protected $casts = [
		'email_verified_at' => 'datetime',
	];

	public static $rules = array(
		'name' => 'bail|required|max:15',
		'user_id' => [
			'bail',
			'required',
			'max:30',
			'unique:App\User'
		],
	);

	protected $with = ['detail'];

	public function admin(){
		return $this->hasOne('App\Admin');
	}

	public function detail(){
		$detail =  $this->hasOne('App\UserDetail');
		return $detail;
	}

	public function prof_path(){
		if($this->detail->prof_img){
			$prof_path = 'storage/img/prof/'.$this->detail->prof_img;
		}else{
			$prof_path = 'img/account.svg';
		}
		return asset($prof_path);
	}

	public function good(){
		return $this->hasMany('App\Good');
	}

	public function good_posts(){
		return $this->belongsToMany('App\Post', 'goods')
		->whereNull('goods.deleted_at')
		->withTimestamps();
	}

	public function basket_posts(){
		return $this->belongsToMany('App\Post', 'user_baskets')
		->whereNull('user_baskets.deleted_at')
		->withTimestamps();
	}

	public function href(){
		return route('user', ['user_id' => $this->user_id]);
	}

	public function posts(){
		return $this->hasMany('App\Post');
	}

	public function notifications(){
		return $this->hasMany('App\UserNotification');
	}

	public function unreceivedNotifications(){
		return $this->hasMany('App\UserNotification')->whereNull('received_at');
	}

	public function unreceivedActiveNotifications(){
		return $this->hasMany('App\UserNotification')
		->whereHasMorph('notifiable', ['App\Good', 'App\UserBasket', 'App\PostReference'])
		->whereNull('received_at');
	}

	public function notification_config(){
		return $this->hasOne('App\UserNotificationConfig');
	}

		public function isAdmin(){
		if(!empty($this->admin)){
			return true;
		}else{
			return false;
		}
	}

	public function action_logs(){
		return $this->hasMany('App\ActionLog');
	}

}