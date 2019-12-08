<?php

use Illuminate\Database\Eloquent\Factory;
use Illuminate\Database\Seeder;

class DriverTableSeeder extends Seeder
{
    public function run()
    {
        factory(App\Driver::class, 9)->create();

        \App\Driver::all()->each(function ($driver) {
            $driver->slug = str_replace('.', '', str_replace(" ", "", $driver->name . $driver->last_name));
            $driver->save();
        });
    }
}
