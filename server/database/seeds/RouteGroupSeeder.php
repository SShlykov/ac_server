<?php

use Illuminate\Database\Seeder;

class RouteGroupSeeder extends Seeder
{
    public function run()
    {
        factory(App\RouteGroup::class, 5)->create();
    }
}
