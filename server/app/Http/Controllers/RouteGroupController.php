<?php

namespace App\Http\Controllers;

use App\RouteGroup;
use App\Http\Resources\RouteGroup as RouteGroupResource;
use Illuminate\Http\Request;

class RouteGroupController extends Controller
{
    public function index($count)
    {
        $count = gettype(intval($count)) == 'integer' ? $count: 5;
        $routeGroup = RouteGroup::paginate($count);
        return RouteGroupResource::collection($routeGroup);
    }

    public function store(Request $request)
    {
        $routeGroup = $request->isMethod('put') ? RouteGroup::findOrFail($request->id)
            : new RouteGroup;

        $routeGroup->id = $request->input('id');
        $routeGroup->name = $request->input('name');
        $routeGroup->latitude = $request->input('latitude');
        $routeGroup->longitude = $request->input('longitude');

        $routeGroup->save();
        return new RouteGroupResource($routeGroup);
    }

    public function show($id)
    {
        $review = RouteGroup::findOrFail($id);

        return new RouteGroupResource($review);
    }

    public function destroy($id)
    {
        try {
            $routeGroup = RouteGroup::findOneOrFail();
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
