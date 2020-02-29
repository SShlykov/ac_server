<?php

namespace App\Http\Controllers;

use Storage;
use File;
use Illuminate\Http\Request;
use App\Driver;
use App\Carphoto;
use App\Tour;

class PhotosController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $driverPhotos = Driver::pluck('photo');
        $carsFront = Carphoto::pluck('car_photo_front');
        $carsSide = Carphoto::pluck('car_photo_side');
        $carsBack = Carphoto::pluck('car_photo_back');
        $toursPhotos = Tour::pluck('image');
        
        //$avatars = Storage::disk('public')->files('avatars');
        // $arrayPhotos = array_merge( $driverPhotos, $carsFront); 
        $files = Storage::AllFiles('');
    
        return $files;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
