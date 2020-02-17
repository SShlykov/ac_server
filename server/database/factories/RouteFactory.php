<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Route;
use Faker\Generator as Faker;

$factory->define(Route::class, function (Faker $faker) {
    return [
        'name' => $faker->unique()->randomElement(['Новосибирск', 'Горный Алтай', 'Бийск', 'Искитим', 'Барнаул', 'Ануйское озеро', 'Белокуриха', 'Кош-Агач', 'Косиха', 'Озерки', 'Маралиха', 'Тигирек', 'Черга', 'Телецкое']),
        'latitude' => $faker->unique()->randomElement(['51.700241', '52.240010', '51.820781', '52.279471', '52.523166', '53.367205', '53.177179', '53.205777', '53.305675', '53.318151', '53.246793']),
        'longitude' => $faker->unique()->randomElement(['87.851680', ' 87.024958', '85.767571', '84.855356', '82.619056', '84.781714', '84.570729', '83.881135', '83.559699', '83.241527']),

    ];
});
