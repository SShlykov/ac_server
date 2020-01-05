<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\RouteGroup;
use Faker\Generator as Faker;

$factory->define(RouteGroup::class, function (Faker $faker) {
    return [
        'name' => $faker->randomElement(['Новосибирск', 'Горный Алтай', 'Бийск', 'Искитим', 'Барнаул','Ленинград','Москва','Кош-Агач'])
    ];
});
