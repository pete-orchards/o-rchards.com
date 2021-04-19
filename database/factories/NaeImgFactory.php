<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\NaeImg;
use Faker\Generator as Faker;

$factory->define(NaeImg::class, function (Faker $faker) {
    return [
    	'num' => 1,
    	'img' => 'img.svg',
    ];
});
