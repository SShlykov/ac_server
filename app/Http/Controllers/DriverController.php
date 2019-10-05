<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Driver;
use App\Car;
use App\Carphoto;
use Symfony\Component\HttpKernel\Exception\HttpException;
use App\Http\Resources\Driver as DriverResource;

class DriverController extends Controller
{
    public function index()
    {
        $drivers = Driver::paginate(15);
        return DriverResource::collection($drivers);
    }
    public function store(Request $request)
    {
        $driver = $request->isMethod('put') ? Driver::findOrFail($request->id)
            : new Driver;

        $driver->id = $request->input('id');
        $driver->name = $request->input('name');
        $driver->last_name = $request->input('last_name');
        $driver->photo = $request->input('photo');
        $driver->locale = $request->input('locale');
        $driver->phone = $request->input('phone');

        $driver->save();
        return new DriverResource($driver);
    }

    public function show($id)
    {
        $driver = Driver::findOrFail($id);

        return new DriverResource($driver);
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
                $driver->delete();
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
                "status" => $status
            ];
        }
    }
}
