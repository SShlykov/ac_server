<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Car;
use Faker\Generator as Faker;

$factory->define(Car::class, function (Faker $faker) {
    return [
        'name' => 'Volvo 740',
        'type' => $faker->randomElement(['Седан', 'Внедорожник', 'Минивэн', 'Хэтчбэк']),
        'sits' => $faker->numberBetween(2, 15),
        'fuel' => $faker->randomElement(['Бензин', 'Дизель', 'Газ']),
        'price' => $faker->numberBetween(60, 150),
        'child' => $faker->boolean(50),
        'driver_id' => '1'
    ];
});
