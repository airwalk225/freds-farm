<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use App\daily_milk;
use Faker\Generator as Faker;

$factory->define(daily_milk::class, function (Faker $faker) {
    return [
        'milk_volume' => $faker->randomFloat($nbMaxDecimals = NULL, $min = 0, $max = NULL),
        'cow_id' => $faker->numberBetween($min = 1, $max = 50),
        'milk_datetime' => $faker->date($format = 'Y-m-d H:i:s', $max = 'now')
    ];
});
