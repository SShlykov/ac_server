<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Driver;
use Faker\Generator as Faker;

$factory->define(Driver::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'last_name' => $faker->lastName,
        'phone' => '+79130024328',
        'locale' => $faker->city,
        'photo' => 'https://cdn.vox-cdn.com/thumbor/yIlho6ha-rDjt1pjrbgjT-qeRi0=/0x0:2560x1440/1200x800/filters:focal(1x0:409x408)/cdn.vox-cdn.com/uploads/chorus_image/image/59336187/Dara_Drives__1_.0.png'
    ];
});
