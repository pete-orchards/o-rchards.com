<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\MiImg;
use Faker\Generator as Faker;

$factory->define(MiImg::class, function (Faker $faker) {
    return [
    	'num' => 1,
    	'img' => 'img.svg',
    ];
});
