<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Kangaroo;
use App\Model;
use Faker\Generator as Faker;

$factory->define(Kangaroo::class, function (Faker $faker) {
    return [
        'name' => $faker->firstname,
        'nickname' => $faker->firstname,
        'weight' => $faker->randomFloat(2, 0, 4),
        'height' => $faker->randomFloat(2, 0, 4),
        'gender' => $faker->randomElement(array_keys(Kangaroo::GENDER)),
        'color' => $faker->safeColorName,
        'friendliness' => $faker->boolean,
        'birthday' => $faker->date('Y-m-d', 'now')
    ];
});
