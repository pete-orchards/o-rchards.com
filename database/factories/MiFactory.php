<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Mi;
use Faker\Generator as Faker;

$factory->define(Mi::class, function (Faker $faker) {
    return [
    	'title' => $faker->word,
    	'body' => $faker->realText(500),
    ];
});
