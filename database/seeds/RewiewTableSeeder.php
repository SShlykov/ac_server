<?php

use Illuminate\Database\Seeder;

class RewiewTableSeeder extends Seeder
{
    public function run()
    {
        \App\Driver::all()->each(function ($driver) {
            $rewiew = factory(App\Review::class)->create();
            $driver->rewiew()->save($rewiew);
            $rewiew = factory(App\Review::class)->create();
            $driver->rewiew()->save($rewiew);
        });
    }
}
