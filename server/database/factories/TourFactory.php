<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Tour;
use Faker\Generator as Faker;

$factory->define(Tour::class, function (Faker $faker) {
    return [
        'name' => $faker->numerify('Tour ###'),
        'image' => 'https://sun9-38.userapi.com/c854320/v854320805/1b8e14/afhOhLK6rkU.jpg',
        'time' => 'от 2х часов',
        'text' => $faker->paragraph()
    ];
});
