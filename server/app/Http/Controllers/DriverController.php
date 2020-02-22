<?php

namespace App\Http\Controllers;

use App\Car;
use App\Carphoto;
use App\Driver;
use App\Http\Resources\Driver as DriverResource;
use App\Rewiew;
use App\RouteGroup;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Symfony\Component\HttpKernel\Exception\HttpException;

class DriverController extends Controller
{
    public function showAllDriversData()
    {$bigArray = array();
        $tempArray = array();
        $reviews = array();
        $routeGroup = array();
        $quantity = 0;
        $sum = 0;
        $drivers = Driver::all();
        foreach ($drivers as $driver) {
            $quantity = 0;
            $sum = 0;
            unset($tempArray);
            $tempArray = array();
            unset($reviews);
            $reviews = array();
            unset($routeGroup);
            $routeGroup = array();
            $tempArray['driver'] = $driver;
            $tempArray['car'] = $driver->car;
            $carphoto = $driver->car->carphoto;
            foreach ($driver->rewiew as $rewiew) {
                $quantity++;
                $sum = $sum + $rewiew->rating;
            }
            unset($driver->car);
            unset($driver->rewiew);
            unset($driver->route_group);
            $reviews['quantity'] = $quantity;
            if ($quantity > 0) {
                $reviews['rating'] = round($sum / $quantity, 1);
            } else {
                $reviews['rating'] = 0;
            }
            $tempArray['reviews'] = $reviews;
            foreach ($driver->route_group as $routeG) {
                foreach ($routeG->routes as $route) {
                    if (in_array($route->name, $routeGroup)) {} else {
                        array_push($routeGroup, $route->name);
                    }

                }

            }
            $tempArray['routes'] = $routeGroup;
            $bigArray[] = $tempArray;
        }
        return $bigArray;
    }

    public function index($count)
    {
        $count = gettype(intval($count)) == 'integer' ? $count : 5;
        $drivers = Driver::latest()->paginate($count);
        return DriverResource::collection($drivers);
    }
    public function store(Request $request)
    {

        $exploded = explode(',', $request->photo);
        $isNewPhoto = Str::contains($request->photo, 'base');
        if ($isNewPhoto) {
            $decoded = base64_decode($exploded[1]);

            if (Str::contains($exploded[0], 'jpeg')) {
                $extension = 'jpg';
            } else {
                $extension = 'png';
            }

            $file_name = Str::random(40) . '.' . $extension;

            $path = public_path() . '/' . 'images/' . 'drivers/' . $file_name;

            file_put_contents($path, $decoded);
        }
        $driver = $request->isMethod('put') ? Driver::findOrFail($request->id)
        : new Driver;

        $path_old_photo = '';

        if ($request->isMethod('put')) {
            $path_old_photo = $driver->photo;
        }

        $driver->id = $request->input('id');
        $driver->name = $request->input('name');
        $driver->last_name = $request->input('last_name');
        $driver->locale = $request->input('locale');
        $driver->phone = $request->input('phone');
        if ($isNewPhoto) {
            $driver->photo = '/' . 'images/' . 'drivers/' . $file_name;
        }
        $driver->save();
        $car = $driver->car()->create();
        $car->carphoto()->create();

        if ($path_old_photo) {
            unlink(public_path() . $path_old_photo);
        }

        return new DriverResource($driver);
    }

    public function show($id)
    {
        $driver = Driver::findOrFail($id);

        return new DriverResource($driver);
    }

    public function get_car($id)
    {
        $car = \App\Car::where('driver_id', $id)->first();

        return $car;
    }

    public function addRG($driver_id, $rg_id)
    {
        $driver = Driver::findOrFail($driver_id);

        //$rg = RouteGroup::findOrFail($rg_id);

        $rg = RouteGroup::where('name', $rg_id)->first();

        $driver->route_group()->attach($rg);

        return $driver;
    }

    public function show_connected($driver_id)
    {
        $routeGroups = Driver::find($driver_id)->route_group()->get();

        return $routeGroups;
    }

    public function disconnect(Request $request)
    {
        \Log::info($request);
        $routeGroup = RouteGroup::findOrFail($request->input('route_group_id'));
        $driver_id = Driver::findOrFail($request->input('route_id'));
        $routeGroup->drivers()->detach($driver_id);
        return new DriverResource($routeGroup);
    }

    public function delete($id)
    {
        $driver = Driver::findOrFail($id);
        $driver->delete();

        return $driver;
    }

    public function showWt($count)
    {
        $count = gettype(intval($count)) == 'integer' ? $count : 5;
        $drivers = Driver::withTrashed()->latest()->paginate($count);
        return DriverResource::collection($drivers);
    }

    public function showOt($count)
    {
        $count = gettype(intval($count)) == 'integer' ? $count : 5;
        $drivers = Driver::onlyTrashed()->latest()->paginate($count);
        return DriverResource::collection($drivers);
    }

    public function restore($id)
    {
        $driver = Driver::withTrashed()->findOrFail($id);
        $driver->restore();

        return $driver;
    }

    public function destroy($id)
    {
        try {
            $driver = Driver::findOrFail($id);
            if ($driver) {
                $car = Car::where('driver_id', $driver->id)->first();
                if ($car) {
                    $carphoto = Carphoto::where('car_id', $car->id)->first();
                    if ($carphoto) {
                        $carphoto->delete();
                    }
                    $car->delete();
                }
                $driver->rewiew()->delete();
                $driver->forceDelete();
                return new DriverResource($driver);
            }
        } catch (\Exception $e) {
            $status = 400;
            $message = 'Something went wrong, please, report us';
            if ($e instanceof HttpException) {
                $status = $e->getStatusCode();
                $message = $e->getMessage();
            }
            return [
                "error" => $message,
                "status" => $status,
            ];
        }
    }
}
