<?php

use Illuminate\Database\Seeder;

class TourTableSeeder extends Seeder
{
    public function run()
    {
        factory(App\Tour::class, 8)->create();
        $faker = Faker\Factory::create();
        \App\Tour::all()->each(function ($tour) use ($faker) {
            $category = [];
            $routes = [];

            for ($i = 0; $i < 3; $i++) {
                array_push($category, $faker->numberBetween(1, 5));
            }
            for ($i = 0; $i < 4; $i++) {
                array_push($routes, $faker->numberBetween(1, 10));
            }

            $tour->category()->sync($category);
            $tour->routes()->sync($routes);
        });
    }
}
