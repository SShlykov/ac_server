<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Tour;
use Faker\Generator as Faker;

$factory->define(Tour::class, function (Faker $faker) {
    return [
        'name' => $faker->numerify('Tour ###'),
        'image' => 'https://sun9-37.userapi.com/c857436/v857436599/1818ca/tnjddurPzBc.jpg',
        'time' => 'от 2х часов',
        'text' => $faker->paragraph(),
    ];
});
