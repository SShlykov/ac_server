<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Car;
use App\Carphoto;
use App\Http\Resources\Car as CarResource;

class CarController extends Controller
{
    public function index()
    {
        $car = Car::paginate(15);
        return CarResource::collection($car);
    }

    public function store(Request $request)
    {
        \Log::info($request);
        $car = $request->isMethod('put') ? Car::findOrFail($request->id)
            : new Car;

        $car->id = $request->input('id');
        $car->name = $request->input('name');
        $car->type = $request->input('type');
        $car->sits = $request->input('sits');
        $car->fuel = $request->input('fuel');
        $car->price = $request->input('price');
        $car->child = $request->input('child');
        $car->driver_id = $request->input('driver_id');

        $car->save();
        return new CarResource($car);
    }

    public function show($id)
    {
        $car = Car::findOrFail($id);

        return new CarResource($car);
    }

    public function destroy($id)
    {
        try {
            $car = Car::findOrFail($id);
            if ($car) {
                $carphotos = Carphoto::where('car_id', $car->id)->first();
                if ($carphotos) {
                    $carphotos->delete();
                }
                $car->delete();
                return new CarResource($car);
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
