<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use App\cows;
use Faker\Generator as Faker;

$factory->define(cows::class, function (Faker $faker) {
    return [
        'name' => $faker->firstName,
        'breed' => $faker->firstName,
        'age' => $faker->randomDigitNotNull(),
        'milked_YN' => 'no'
    ];
});
