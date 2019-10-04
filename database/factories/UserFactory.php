<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\User;
use Faker\Generator as Faker;
use Illuminate\Support\Str;

$factory->define(User::class, function (Faker $faker) {
    return [
        'name' => 'Sergey',
        'last_name' => 'Shlykov',
        'email' => 's.n.shlykov@gmail.com',
        'password' => Hash::make(
            'secret'
        ),
        'login' => 'sshlykov'
    ];
});
