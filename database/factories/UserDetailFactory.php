<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\UserDetail;
use Faker\Generator as Faker;

$factory->define(UserDetail::class, function (Faker $faker) {
    return [
        'prof_comment' => $faker->realText(200),
        'prof_img' => 'img.svg',
        'location' => $faker->city,
        'url' => $faker->url,
        'tel' => $faker->phoneNumber,
        'birthday' => $faker->dateTimeBetween('-100 years', 'now'),
    ];
});
