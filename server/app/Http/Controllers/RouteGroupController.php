<?php

namespace App\Http\Controllers;

use App\RouteGroup;
use App\Route;
use \App\Http\Resources\RouteGroup as RouteGroupResource;
use Illuminate\Http\Request;

class RouteGroupController extends Controller
{
    public function index()
    {
	$routeGroup = RouteGroup::all();
	\Log::info($routeGroup);
        return RouteGroupResource::collection($routeGroup);
    }

    public function store(Request $request)
    {
        $routeGroup = $request->isMethod('put') ? RouteGroup::findOrFail($request->id)
        : new RouteGroup;
        
        $routeGroup->id = $request->input('id');
        $routeGroup->name = $request->input('name');
        $routeGroup->save();

        return new RouteGroupResource($routeGroup);
    }

    public function connect(Request $request)
    {
        $routeGroup = RouteGroup::findOrFail($request->input('route_group_id'));

        $route = Route::where('name', ($request->input('route_name')))->first();
        
        $routeGroup->routes()->save($route);

        return new RouteGroupResource($routeGroup);
    }

    public function disconnect(Request $request)
    {
        $routeGroup = RouteGroup::findOrFail($request->input('route_group_id'));
        $route = Route::findOrFail($request->input('route_id'));
        $routeGroup->routes()->detach($route);
        return new RouteGroupResource($routeGroup);
    }

    public function show_connected($id)
    {       
        $routeGroup = RouteGroup::findOrFail($id);
	\Log::info($routeGroup);
        return $routeGroup;
    }



    public function show($id)
    {
        $review = RouteGroup::findOrFail($id);

        return new RouteGroupResource($review);
    }

    public function destroy($id)
    {
        try {
            $routeGroup = RouteGroup::findOrFail($id);
            if ($routeGroup) {
                $routeGroup->delete();
            }
            return new RouteGroupResource($routeGroup);
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
