<?php

use Illuminate\Database\Seeder;

class CarTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Driver::all()->each(function ($driver) {
            $car = factory(App\Car::class)->create();
            $car->driver_id = $driver->id;
            $driver->car()->save($car);
        });
    }
}
