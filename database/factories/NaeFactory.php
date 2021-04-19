<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Nae;
use Faker\Generator as Faker;

$factory->define(Nae::class, function (Faker $faker) {
    return [
    	'title' => $faker->word,
    	'body' => $faker->realText(200),
    ];
});
