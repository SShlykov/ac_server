<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\RouteGroup;
use Faker\Generator as Faker;

$factory->define(RouteGroup::class, function (Faker $faker) {
    return [
        'name' => $faker->unique()->randomElement(['Новосибирск', 'Горный Алтай', 'Бийск', 'Искитим', 'Барнаул','Ленинград','Москва','Кош-Агач', 'Калининград', 'Харватия'])
    ];
});
