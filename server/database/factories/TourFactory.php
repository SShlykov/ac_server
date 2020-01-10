<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Tour;
use Faker\Generator as Faker;

$factory->define(Tour::class, function (Faker $faker) {
    return [
        'name' => $faker->numerify('Tour ###'),
        'image' => 'https://loremflickr.com/640/480/nature',
        'time' => 'от 2х часов',
        'text' => $faker->paragraph()
    ];
});
