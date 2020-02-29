<?php

namespace App\Http\Controllers;

use App\Review;
use Illuminate\Http\Request;
use App\Http\Resources\Review as ReviewResource;
use App\Http\Resources\DReview as DReviewResource;
use Illuminate\Support\Facades\DB;

class ReviewController extends Controller
{
    public function index()
    {
        $reviews = Review::paginate(15);
        return ReviewResource::collection($reviews);
    }


    public function store(Request $request)
    {
        \Log::info($request);
        $review = $request->isMethod('put') ? Review::findOrFail($request->id)
            : new Review;

        $review->id = $request->input('id');
        $review->author = $request->input('author');
        $review->text = $request->input('text');
        $review->rating = $request->input('rating');
        $review->driver_id = $request->input('driver_id');

        $review->save();
        return new ReviewResource($review);
    }

    public function show($id)
    {
        $review = Review::where('driver_id', $id)->first();
        return new ReviewResource($review);

    }

    public function dshow($id)
    {
        $review = Review::all()->where('driver_id', $id);
      //  return new ReviewResource($review);
      return new DReviewResource($review) ;
    }

    public function destroy($id)
    {
        try {
            $review = Review::findOrFail($id);
            if ($review) {
                $review->delete();
            }
            return new ReviewResource($review);
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
