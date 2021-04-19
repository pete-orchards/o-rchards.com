<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Post;
use Faker\Generator as Faker;

$factory->define(Post::class, function (Faker $faker) {
    return [
    ];
});

$factory->state(Post::class, 'tane', function($faker){
	return 	[
		'post_type_id' => 1,
	];
});

$factory->state(Post::class, 'nae', function($faker){
	return 	[
		'post_type_id' => 2,
	];
});

$factory->state(Post::class, 'mi', function($faker){
	return 	[
		'post_type_id' => 3,
	];
});
