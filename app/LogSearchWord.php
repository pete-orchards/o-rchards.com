<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class LogSearchWord extends Model
{
	const UPDATED_AT = null;

	protected $fillable = [
		'logged_at',
		'user_id',
		'keywords',
		'types',
		'remote_addr',
	];

}
