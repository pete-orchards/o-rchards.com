<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
	protected $fillable = [
		'name', 'email', 'message',
	];

	public static $rules = array(
		'name' => 'bail|required|max:20',
		'email' => 'bail|required|email',
		'message' => 'bail|required|max:1200',
	);
}