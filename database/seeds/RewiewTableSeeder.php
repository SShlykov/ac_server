<?php

use Illuminate\Database\Seeder;

class RewiewTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Driver::all()->each(function ($driver) {
            $rewiew = factory(App\Rewiew::class)->create();
            $driver->rewiew()->save($rewiew);
            $rewiew = factory(App\Rewiew::class)->create();
            $driver->rewiew()->save($rewiew);
        });
    }
}
