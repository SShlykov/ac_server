<?php

namespace App\Http\Controllers;

use App\AltaySettings;
use App\Http\Resources\AltaySettings as AltaySettingsResource;
use Illuminate\Http\Request;

class AltaySettingsController extends Controller
{
    public function index()
    {
        $altay = AltaySettings::all();

        return AltaySettingsResource::collection($altay);
    }

    public function update(Request $request)
    {
        $altay = AltaySettings::findOrFail($request->id);

        $altay->id = $request->input('id');
        $altay->name = $request->input('name');
        $altay->text = $request->input('text');
        $altay->heading = $request->input('heading');

        $altay->save();

        return $altay;
    }
    public function deletephotos()
    {

        $folder_cars = public_path() . '/images/cars/';
        $folder_tours = public_path() . '/images/tours/';
        $folder_drivers = public_path() . '/images/drivers/';

        unlink($folder_tours . '9xFn7dKEqcyF6zk7NRsOuxj8V0rQfi0GqbS6HqbK.jpg');

        $scan_cars = scandir($folder_cars);
        $scan_tours = scandir($folder_tours);
        $scan_drivers = scandir($folder_drivers);

        $result = ['cars' => $scan_cars, 'tours' => $scan_tours, 'drivers' => $scan_drivers];

        return $result;

    }
}
