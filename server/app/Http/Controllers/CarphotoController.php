<?php

namespace App\Http\Controllers;

use App\Carphoto;
use App\Http\Resources\Carphoto as CarphotoResource;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class CarphotoController extends Controller
{
    public function index()
    {
        $carphotos = Carphoto::paginate(15);
        return CarphotoResource::collection($carphotos);
    }

    public function store(Request $request)
    {
        \Log::info('function is empty');
    }

    public function postBackPhoto(Request $request)
    {

        $exploded = explode(',', $request->photo);
        $decoded = base64_decode($exploded[1]);

        if (Str::contains($exploded[0], 'jpeg')) {
            $extension = 'jpg';
        } else {
            $extension = 'png';
        }

        $file_name = Str::random(40) . '.' . $extension;

        $path = public_path() . '/' . 'images/' . 'cars/' . $file_name;

        file_put_contents($path, $decoded);

        $carphotos = $request->isMethod('put') ? Carphoto::findOrFail($request->id)
        : new Carphoto;

        if ($request->isMethod('put')) {
            $path_old_photo = $carphotos->car_photo_back;
        }

        $carphotos->car_photo_back = '/' . 'images/' . 'cars/' . $file_name;

        $carphotos->id = $request->input('id');

        $carphotos->save();

        if ($path_old_photo) {
            unlink(public_path() . $path_old_photo);
        }

        return new CarphotoResource($carphotos);
    }
    public function postFrontPhoto(Request $request)
    {
        $exploded = explode(',', $request->photo);
        $decoded = base64_decode($exploded[1]);

        if (Str::contains($exploded[0], 'jpeg')) {
            $extension = 'jpg';
        } else {
            $extension = 'png';
        }

        $file_name = Str::random(40) . '.' . $extension;

        $path = public_path() . '/' . 'images/' . 'cars/' . $file_name;

        file_put_contents($path, $decoded);

        $carphotos = $request->isMethod('put') ? Carphoto::findOrFail($request->id)
        : new Carphoto;

        $path_old_photo;

        if ($request->isMethod('put')) {
            $path_old_photo = $carphotos->car_photo_front;
        }

        $carphotos->car_photo_front = '/' . 'images/' . 'cars/' . $file_name;

        $carphotos->id = $request->input('id');

        $carphotos->save();

        if ($path_old_photo) {
            unlink(public_path() . $path_old_photo);
        }

        return new CarphotoResource($carphotos);
    }
    public function postSidePhoto(Request $request)
    {
        $exploded = explode(',', $request->photo);
        $decoded = base64_decode($exploded[1]);

        if (Str::contains($exploded[0], 'jpeg')) {
            $extension = 'jpg';
        } else {
            $extension = 'png';
        }

        $file_name = Str::random(40) . '.' . $extension;

        $path = public_path() . '/' . 'images/' . 'cars/' . $file_name;

        file_put_contents($path, $decoded);

        $carphotos = $request->isMethod('put') ? Carphoto::findOrFail($request->id)
        : new Carphoto;

        $path_old_photo;

        if ($request->isMethod('put')) {
            $path_old_photo = $carphotos->car_photo_side;
        }

        $carphotos->car_photo_side = '/' . 'images/' . 'cars/' . $file_name;

        $carphotos->id = $request->input('id');

        $carphotos->save();

        if ($path_old_photo) {
            unlink(public_path() . $path_old_photo);
        }

        return new CarphotoResource($carphotos);
    }

    public function show($id)
    {
        $carphotos = Carphoto::where('car_id', $id)->first();

        return new CarphotoResource($carphotos);
    }

    public function destroy($id)
    {
        try {
            $carphotos = Carphoto::findOrFail($id);
            if ($carphotos) {
                $carphotos->delete();
            }
            return new CarphotoResource($carphotos);
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
