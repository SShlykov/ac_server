<?php

use Illuminate\Database\Seeder;

class CarphotoTableSeeder extends Seeder
{
    public function run()
    {
        \App\Car::all()->each(function ($car) {
            $carphotos = factory(App\Carphoto::class)->create();
            $car->carphoto()->save($carphotos);
        });
    }
}
