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
        $exploded = explode(',', $request->photo);
        $decoded = base64_decode($exploded[1]);

        
        if(Str::contains($exploded[0], 'jpeg'))
        $extension = 'jpg';
        else
        $extension = 'png';
        
        
        $file_name = Str::random(40).'.'.$extension;
        
        $path = public_path().'/'.'images/'.'cars/'.$file_name;
        
        file_put_contents($path, $decoded);

        $carphotos = $request->isMethod('put') ? Carphoto::findOrFail($request->id)
            : new Car;

        $carphotos->photo = '/'.'images/'.'drivers/'.$file_name;

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
