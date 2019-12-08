<?php

use Illuminate\Database\Seeder;

class CategoryTableSeeder extends Seeder
{
    public function run()
    {
        factory(App\Category::class, 8)->create();
    }
}
