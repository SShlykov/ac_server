<?php

use Illuminate\Http\Request;

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});


Route::get('drivers/{count}', 'DriverController@index');
Route::get('cars/{count}', 'CarController@index');
Route::get('carphotos/{count}', 'CarphotoController@index');
Route::get('reviews/{count}', 'ReviewController@index');
Route::get('routes/{count}', 'RouteController@index');
Route::get('tours/{count}', 'TourController@index');

Route::group(['prefix' => 'driver'], function (){
    $controller = "DriverController@";
    Route::get('/{id}', $controller . 'show');
    Route::post('/', $controller . 'store');
    Route::put('/', $controller . 'store');
    Route::delete('/{id}', $controller . 'destroy');
});

Route::group(['prefix' => 'car'], function (){
    $controller = "CarController@";
    Route::get('/{id}', $controller . 'show');
    Route::post('/', $controller . 'store');
    Route::put('/', $controller . 'store');
    Route::delete('/{id}', $controller . 'destroy');
});

Route::group(['prefix' => 'carphoto'], function (){
    $controller = "CarphotoController@";
    Route::get('/{id}', $controller . 'show');
    Route::post('/', $controller . 'store');
    Route::put('/', $controller . 'store');
    Route::delete('/{id}', $controller . 'destroy');
});

Route::group(['prefix' => 'review'], function (){
    $controller = "ReviewController@";
    Route::get('/{id}', $controller . 'show');
    Route::post('/', $controller . 'store');
    Route::put('/', $controller . 'store');
    Route::delete('/{id}', $controller . 'destroy');
});

Route::group(['prefix' => 'route'], function (){
    $controller = "RouteController@";
    Route::get('/{id}', $controller . 'show');
    Route::post('/', $controller . 'store');
    Route::put('/', $controller . 'store');
    Route::delete('/{id}', $controller . 'destroy');
});

Route::group(['prefix' => 'tour'], function (){
    $controller = "TourController@";
    Route::get('/{id}', $controller . 'show');
    Route::post('/', $controller . 'store');
    Route::put('/', $controller . 'store');
    Route::delete('/{id}', $controller . 'destroy');
});
