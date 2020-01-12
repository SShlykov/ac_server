<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        $this->call(UserTableSeeder::class);

        $this->call(CategoryTableSeeder::class);
        $this->call(RouteTableSeeder::class);
        $this->call(TourTableSeeder::class);
        
        $this->call(DriverTableSeeder::class);
        $this->call(CarTableSeeder::class);
        $this->call(CarphotoTableSeeder::class);
        $this->call(RewiewTableSeeder::class);

        $this->call(RouteGroupSeeder::class);

        //$this->call(AltaySettingsTableSeeder::class);
    }
}
