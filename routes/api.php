<?php

use Illuminate\Http\Request;

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('drivers', 'DriverController@index');

Route::get('driver/{id}', 'DriverController@show');

Route::post('driver', 'DriverController@store');

Route::put('driver', 'DriverController@store');

Route::delete('driver/{id}', 'DriverController@destroy');
