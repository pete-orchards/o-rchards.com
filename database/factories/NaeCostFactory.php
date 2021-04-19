<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\NaeCost;
use Faker\Generator as Faker;

$factory->define(NaeCost::class, function (Faker $faker) {
    return [
    	'num' => 1,
    	'name' => $faker->word,
    	'amount' => $faker->numberBetween(1, 100000),
    	'volume' => $faker->numberBetween(1, 100),
    ];
});
