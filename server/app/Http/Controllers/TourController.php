<?php

namespace App\Http\Controllers;

use App\Category;
use App\Http\Resources\Tour as TourResource;
use App\Route;
use App\Tour;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class TourController extends Controller
{
    public function index()
    {
        $tours = Tour::paginate(15);
        return TourResource::collection($tours);
    }

    public function postphoto(Request $request)
    {

        $exploded = explode(',', $request->image);
        $decoded = base64_decode($exploded[1]);

        if (Str::contains($exploded[0], 'jpeg')) {
            $extension = 'jpg';
        } else {
            $extension = 'png';
        }

        $file_name = Str::random(40) . '.' . $extension;

        $path = public_path() . '/' . 'images/' . 'tours/' . $file_name;

        file_put_contents($path, $decoded);

        $tour = Tour::findOrFail($request->id);

        $path_old_photo = '';

        $have = strpos($tour->image, "https://");

        if ($have !== 0) {
            $path_old_photo = $tour->image;
        }

        $tour->image = '/' . 'images/' . 'tours/' . $file_name;

        $tour->id = $request->input('id');

        $tour->save();

        if ($path_old_photo) {
            unlink(public_path() . $path_old_photo);
        }

        return $tour;
    }

    public function all()
    {
        $tours = Tour::all();

        return TourResource::collection($tours);
    }

    public function store(Request $request)
    {
        $tour = $request->isMethod('put') ? Tour::findOrFail($request->id)
        : new Tour;

        $tour->id = $request->input('id');
        $tour->name = $request->input('name');
        $tour->image = $request->input('image');
        $tour->time = $request->input('time');
        $tour->text = $request->input('text');

        $tour->save();
        return new TourResource($tour);
    }

    public function show($id)
    {
        $tour = Tour::findOrFail($id);

        return new TourResource($tour);
    }

    public function show_category($id)
    {
        $tour = Tour::findOrFail($id)->category()->get();

        return $tour;
    }

    public function connect_category(Request $request)
    {

        $tour = Tour::findOrFail($request->input('tour_id'));

        $category = Category::where('name', ($request->input('category_name')))->first();

        $tour->category()->attach($category);

        return new TourResource($tour);
    }

    public function disconnet_category(Request $request)
    {
        $tour = Tour::findOrFail($request->input('route_id'));

        $category = Category::findOrFail($request->input('route_group_id'));

        $tour->category()->detach($category);

        return new TourResource($tour);
    }

    public function disconnet_route(Request $request)
    {
        \Log::info($request);

        $tour = Tour::findOrFail($request->input('tour_id'));

        $route = Route::findOrFail($request->input('route_id'));

        $tour->routes()->detach($route);

        return new TourResource($tour);
    }

    public function connect_route_to_tour(Request $request)
    {

        $tour = Tour::findOrFail($request->input('tour_id'));

        $route = Route::where('name', ($request->input('route_name')))->first();

        $tour->routes()->attach($route);

        return new TourResource($tour);

    }

    public function show_routes($tourid)
    {
        $tour = Tour::find($tourid)->routes()->get();

        return $tour;
    }

    public function destroy($id)
    {

        try {
            $tour = Tour::findOrFail($id);
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
                "status" => $status,
            ];
        }
    }
}
