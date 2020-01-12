<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\User;
use Faker\Generator as Faker;
use Illuminate\Support\Str;

$factory->define(User::class, function (Faker $faker) {
    return [
        'name' => 'Maria',
        'last_name' => 'Ur',
        'email' => 'your_mail@mail.ru',
        'password' => Hash::make(
            'secret'
        ),
        'login' => 'admin'
    ];
});
