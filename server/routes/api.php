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

Route::group(['prefix' => 'driver'], function () {
    $controller = "DriverController@";
    Route::get('/{id}', $controller . 'show');
    Route::get('/showall/driversData', $controller . 'showAllDriversData');
    Route::get('/withTrashed/{count}', $controller . 'showWT');
    Route::get('/onlyTrashed/{count}', $controller . 'showOT');
    Route::get('/rg/show_connected/{driver_id}', $controller . 'show_connected');
    Route::get('/car/get_car/{id}', $controller . 'get_car');
    Route::put('/restore/{id}', $controller . 'restore');
    Route::post('/', $controller . 'store');
    Route::post('/rg/connect/{driver_id}/{rg_id}', $controller . 'addRG');
    Route::put('/', $controller . 'store');
    Route::delete('/delete/{id}', $controller . 'destroy');
    Route::delete('/rg/disconnect', $controller . 'disconnect');
    Route::delete('/{id}', $controller . 'delete');
});

Route::group(['prefix' => 'car'], function () {
    $controller = "CarController@";
    Route::get('/{id}', $controller . 'show');
    Route::post('/', $controller . 'store');
    Route::put('/', $controller . 'store');
    Route::delete('/{id}', $controller . 'destroy');
});

Route::group(['prefix' => 'carphoto'], function () {
    $controller = "CarphotoController@";
    Route::get('/{id}', $controller . 'show');
    Route::post('/', $controller . 'store');
    Route::put('/', $controller . 'store');
    Route::put('/back', $controller . 'postBackPhoto');
    Route::put('/front', $controller . 'postFrontPhoto');
    Route::put('/side', $controller . 'postSidePhoto');
    Route::delete('/{id}', $controller . 'destroy');
});

Route::group(['prefix' => 'review'], function () {
    $controller = "ReviewController@";
    Route::get('/driver/{id}', $controller . 'dshow');
    Route::get('/{id}', $controller . 'show');
    Route::post('/', $controller . 'store');
    Route::put('/', $controller . 'store');
    Route::delete('/{id}', $controller . 'destroy');
});

Route::group(['prefix' => 'route'], function () {
    $controller = "RouteController@";
    Route::get('/{id}', $controller . 'show');
    Route::get('/routes/all', $controller . 'all');
    Route::get('/wrg/{id}', $controller . 'showRG');
    Route::get('/name/{name}', $controller . 'show_name');
    Route::post('/', $controller . 'store');
    Route::put('/', $controller . 'store');
    Route::delete('/{id}', $controller . 'destroy');
});

Route::group(['prefix' => 'route_group'], function () {
    $controller = "RouteGroupController@";
    Route::get('/groups', $controller . 'index');
    Route::get('/{id}', $controller . 'show');
    Route::get('/show_connected/{id}', $controller . 'show_connected');
    Route::post('/connect', $controller . 'connect');
    Route::post('/', $controller . 'store');
    Route::put('/', $controller . 'store');
    Route::delete('/{id}', $controller . 'destroy');

});

Route::group(['prefix' => 'routes_rout_group'], function () {
    $controller = "RoutesRouteGroupController@";
    Route::post('/', $controller . 'store');
    Route::put('/', $controller . 'store');
    Route::delete('/{id}', $controller . 'destroy');
});

Route::group(['prefix' => 'tour'], function () {
    $controller = "TourController@";
    Route::get('/{id}', $controller . 'show');
    Route::get('/all', $controller . 'all');
    Route::get('/show/routes/{tourid}', $controller . 'show_routes');
    Route::get('/category/{id}', $controller . 'show_category');
    Route::post('/connect/category', $controller . 'connect_category');
    Route::post('/', $controller . 'store');
    Route::post('/connect/route', $controller . 'connect_route_to_tour');
    Route::put('/', $controller . 'store');
    Route::put('/upload/photo', $controller . 'postphoto');
    Route::delete('/{id}', $controller . 'destroy');
    Route::delete('/disconnect/category', $controller . 'disconnet_category');
    Route::delete('/disconnect/route', $controller . 'disconnet_route');

});

Route::group(['prefix' => 'settings'], function () {
    $controller = "PhotosController@";
    Route::get('/updatePhotos', $controller . 'index');
});

Route::group(['prefix' => 'category'], function () {
    $controller = "CategoryController@";
    Route::get('/all', $controller . 'index');
    Route::get('/getTours/{id}', $controller . 'show_tours');
    Route::put('/update', $controller . 'update');
});

Route::group(['prefix' => 'notices'], function () {
    $controller = "NoticesController@";
    Route::get('/get', $controller . 'index');
    Route::get('/getall', $controller . 'getAll');
    Route::put('/additem', $controller . 'addItem');
    Route::put('/updateitem', $controller . 'updateItem');
    Route::delete('/deleteitem', $controller . 'deleteItem');
});

Route::delete('/disconnect', 'RouteGroupController@disconnect');
Route::get('/alltour', 'TourController@all');

Route::group(['prefix' => 'settings'], function () {
    $controller = "AltaySettingsController@";
    Route::get('/all', $controller . 'index');
    Route::get('/deletephotos', $controller . 'deletephotos');
    Route::put('/update', $controller . 'update');

});
