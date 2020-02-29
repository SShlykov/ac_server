<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Review;
use Faker\Generator as Faker;

$factory->define(Review::class, function (Faker $faker) {
    return [
        'author' => $faker->name() . ' ' . $faker->lastName(),
        'text' => $faker->paragraph(),
        'rating' => $faker->numberBetween(1, 5),
        'driver_id' => '1'
    ];
});
