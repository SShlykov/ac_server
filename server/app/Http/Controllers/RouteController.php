<?php

namespace App\Http\Controllers;

use App\Route;
use App\Http\Resources\Route as RouteResource;
use Illuminate\Http\Request;

class RouteController extends Controller
{
    public function index($count)
    {
        $count = gettype(intval($count)) == 'integer' ? $count: 5;
        $route = Route::paginate($count);
        return RouteResource::collection($route);
    }

    public function all()
    {
        $routes = Route::all();
        return RouteResource::collection($routes);
    }

    public function store(Request $request)
    {
        $route = $request->isMethod('put') ? Route::findOrFail($request->id)
            : new Route;

        $route->id = $request->input('id');
        $route->name = $request->input('name');
        $route->latitude = $request->input('latitude');
        $route->longitude = $request->input('longitude');

        $route->save();
        return new RouteResource($route);
    }

    public function show($id)
    {
        $review = Route::findOrFail($id);

        return new RouteResource($review);
    }

    public function show_name($name)
    {
        \Log::info('DB request:');
        \Log::info($request);

        $review =  Route::where('name', $name)->first();

        \Log::info('DB review:');
        \Log::info($review);

        return new RouteResource($review);
    }

    public function showRG($id)
    {
        $route = Route::find($id)->route_groups()->get();

        return $route;
    }

    public function destroy($id)
    {
        
        try {
            $route = Route::findOrFail($id);
            if ($route) {
                $route->delete();
            }
            return new RouteResource($route);
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
