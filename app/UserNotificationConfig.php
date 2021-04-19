<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserNotificationConfig extends Model
{
	protected $fillable = [
		'mail_general', 'push_general',
	];

	public function user()
	{
		return $this->belongsTo('App\User');
	}

}
