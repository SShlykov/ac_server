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
    Route::get('/withTrashed/{count}', $controller . 'showWT');
    Route::get('/onlyTrashed/{count}', $controller . 'showOT');
    Route::get('/rg/show_connected/{driver_id}', $controller . 'show_connected');
    Route::put('/restore/{id}', $controller . 'restore');
    Route::post('/', $controller . 'store');
    Route::post('/rg/connect/{driver_id}/{rg_id}', $controller . 'addRG');
    Route::put('/', $controller . 'store');
    Route::delete('/delete/{id}', $controller . 'destroy');
    Route::delete('/rg/disconnect', $controller . 'disconnect');
    Route::delete('/{id}', $controller . 'delete');
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
    Route::put('/back', $controller . 'postBackPhoto');
    Route::put('/front', $controller . 'postFrontPhoto');
    Route::put('/side', $controller . 'postSidePhoto');
    Route::delete('/{id}', $controller . 'destroy');
});

Route::group(['prefix' => 'review'], function (){
    $controller = "ReviewController@";
    Route::get('/driver/{id}', $controller . 'dshow');
    Route::get('/{id}', $controller . 'show');
    Route::post('/', $controller . 'store');
    Route::put('/', $controller . 'store');
    Route::delete('/{id}', $controller . 'destroy');
});

Route::group(['prefix' => 'route'], function (){
    $controller = "RouteController@";
    Route::get('/{id}', $controller . 'show');
    Route::get('/wrg/{id}', $controller . 'showRG');
    Route::get('/name/{name}', $controller . 'show_name');
    Route::post('/', $controller . 'store');
    Route::put('/', $controller . 'store');
    Route::delete('/{id}', $controller . 'destroy');
});

Route::group(['prefix' => 'route_group'], function (){
    $controller = "RouteGroupController@";
    Route::get('/groups', $controller . 'index');
    Route::get('/{id}', $controller . 'show');
    Route::get('/show_connected/{id}', $controller . 'show_connected');
    Route::post('/connect', $controller . 'connect');
    Route::post('/', $controller . 'store');
    Route::put('/', $controller . 'store');
    Route::delete('/{id}', $controller . 'destroy');
    
});


Route::delete('/disconnect', 'RouteGroupController@disconnect');

Route::group(['prefix' => 'routes_rout_group'], function (){
    $controller = "RoutesRouteGroupController@";
    Route::post('/', $controller . 'store');
    Route::put('/', $controller . 'store');
    Route::delete('/{id}', $controller . 'destroy');
});

Route::group(['prefix' => 'tour'], function (){
    $controller = "TourController@";
    Route::get('/{id}', $controller . 'show');
    Route::get('/all', $controller . 'show_all');
    Route::get('/category/{id}', $controller . 'show_category');
    Route::post('/', $controller . 'store');
    Route::post('/connect/route', $controller . 'connect_rout_to_tour');
    Route::put('/', $controller . 'store');
    Route::delete('/{id}', $controller . 'destroy');
});

Route::group(['prefix' => 'category'], function (){
    $controller = "CategoryController@";
    Route::get('/', $controller . 'index');
});

