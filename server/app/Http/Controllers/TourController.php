<?php

namespace App\Http\Controllers;

use App\Tour;
use App\Http\Resources\Tour as TourResource;
use Illuminate\Http\Request;

class TourController extends Controller
{
    public function index()
    {
        $tours = Tour::paginate(15);
        return TourResource::collection($tours);
    }

    public function all()
    {
        $tours = Tour::all();

        return TourResource::collection($tours);
    }

    public function store(Request $request)
    {
        \Log::info($request);

        $tour = $request->isMethod('put') ? Tour::findOrFail($request->id)
            : new Tour;

        $tour->id = $request->input('id');
        $tour->name = $request->input('name');
        $tour->image = $request->input('image');
        $tour->time = $request->input('time');

        $tour->save();
        return new TourResource($tour);
    }

    public function show($id)
    {
        $tour = Tour::findOrFail($id);

        return new TourResource($tour);
    }

    public function show_category($id){
        $tour = Tour::findOrFail($id)->category()->get();

        return $tour;
    }

    public function connect_rout_to_tour(Request $request)
    {   
        $tour = Tour::findOrFail($request->input('tour_id'));

        $route = \App\Route::findOrFail($request->input('route_id'));

        $tour->routes()->attach($route);

        return new TourResource($tour);

    }

    public function destroy($id)
    {
        try {
            $tour = Tour::findOneOrFail();
            if ($tour->delete()) {
                return new TourResource($tour);
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
