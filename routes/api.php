<?php

use Illuminate\Http\Request;

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

// Driver routes and data around drivers (Cars, Carphotos and Rewiews)

Route::get('drivers', 'DriverController@index');
Route::get('driver/{id}', 'DriverController@show');
Route::post('driver', 'DriverController@store');
Route::put('driver', 'DriverController@store');
Route::delete('driver/{id}', 'DriverController@destroy');

Route::get('cars', 'CarController@index');
Route::get('car/{id}', 'CarController@show');
Route::post('car', 'CarController@store');
Route::put('car', 'CarController@store');
Route::delete('car/{id}', 'CarController@destroy');

Route::get('carphotos', 'CarphotoController@index');
Route::get('carphoto/{id}', 'CarphotoController@show');
Route::post('carphoto', 'CarphotoController@store');
Route::put('carphoto', 'CarphotoController@store');
Route::delete('carphoto/{id}', 'CarphotoController@destroy');

Route::get('reviews', 'ReviewController@index');
Route::get('review/{id}', 'ReviewController@show');
Route::post('review', 'ReviewController@store');
Route::put('review', 'ReviewController@store');
Route::delete('review/{id}', 'ReviewController@destroy');

// Routes for tours and routes
Route::get('routes', 'RouteController@index');
Route::get('route/{id}', 'RouteController@show');
Route::post('route', 'RouteController@store');
Route::put('route', 'RouteController@store');
Route::delete('route/{id}', 'RouteController@destroy');

Route::get('tours', 'TourController@index');
Route::get('tour/{id}', 'TourController@show');
Route::post('tour', 'TourController@store');
Route::put('tour', 'TourController@store');
Route::delete('tour/{id}', 'TourController@destroy');
