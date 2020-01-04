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

    public function show_all()
    {
        $tours = Tour::all();

        return new TourResource($tours);
    }

    public function store(Request $request)
    {
        $tour = $request->isMethod('put') ? TourResource::findOrFail($request->id)
            : new TourResource;

        $tour->id = $request->input('id');
        $tour->author = $request->input('author');
        $tour->text = $request->input('text');
        $tour->rating = $request->input('rating');
        $tour->driver_id = $request->input('driver_id');

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
