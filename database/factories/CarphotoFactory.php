<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Carphoto;
use Faker\Generator as Faker;

$factory->define(Carphoto::class, function (Faker $faker) {
    return [
        'car_photo_front' => 'https://loremflickr.com/640/480/car',
        'car_photo_side' => 'https://loremflickr.com/640/480/car',
        'car_photo_back' => 'https://loremflickr.com/640/480/car',
        'car_id' => '1'
    ];
});
