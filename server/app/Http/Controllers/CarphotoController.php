<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Carphoto;
use App\Http\Resources\Carphoto as CarphotoResource;

class CarphotoController extends Controller
{
    public function index()
    {
        $carphotos = Carphoto::paginate(15);
        return CarphotoResource::collection($carphotos);
    }

    public function store(Request $request)
    {
        $carphotos = $request->isMethod('put') ? Carphoto::findOrFail($request->id)
            : new Car;

        $carphotos->id = $request->input('id');


        $carphotos->save();
        return new CarphotoResource($carphotos);
    }

    public function show($id)
    {
        $carphotos = Carphoto::findOrFail($id);

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
                "status" => $status
            ];
        }
    }
}
