<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Tane;
use Faker\Generator as Faker;

$factory->define(Tane::class, function (Faker $faker) {
    return [
    	'title' => $faker->word,
    	'body' => $faker->realText(100),
    ];
});
