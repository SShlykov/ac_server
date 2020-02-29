<?php

use App\Route;
use Illuminate\Database\Seeder;

class RouteTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = new Route;
        $data->name = "Новосибирск";
        $data->latitude = 55.012740;
        $data->longitude = 82.931132;
        $data->save();
        $data = new Route;
        $data->name = "Бердск";
        $data->latitude = 54.758633;
        $data->longitude = 83.100703;
        $data->save();
        $data = new Route;
        $data->name = "Искитим";
        $data->latitude = 54.641767;
        $data->longitude = 83.308496;
        $data->save();
        $data = new Route;
        $data->name = "Черепаново";
        $data->latitude = 54.218153;
        $data->longitude = 83.366936;
        $data->save();
        $data = new Route;
        $data->name = "Красноярск";
        $data->latitude = 56.043713;
        $data->longitude = 92.909880;
        $data->save();
        $data = new Route;
        $data->name = "Барнаул";
        $data->latitude = 53.353694;
        $data->longitude = 83.768137;
        $data->save();
        $data = new Route;
        $data->name = "Бийск";
        $data->latitude = 52.518533;
        $data->longitude = 85.159495;
        $data->save();
        $data = new Route;
        $data->name = "Горно-Алтайск";
        $data->latitude = 51.958485;
        $data->longitude = 85.968511;
        $data->save();
        $data = new Route;
        $data->name = "Телецкое озеро";
        $data->latitude = 51.788802;
        $data->longitude = 87.322737;
        $data->save();
        $data = new Route;
        $data->name = "Акташ";
        $data->latitude = 50.312101;
        $data->longitude = 87.605082;
        $data->save();
        $data = new Route;
        $data->name = "Абакан";
        $data->latitude = 53.724509;
        $data->longitude = 91.441431;
        $data->save();

    }
}
