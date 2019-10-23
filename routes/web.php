<?php

Route::get('/', function () {
    if (Auth::user()) {
        return redirect('/home');
    }
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/home/drivers', 'HomeController@drivers');
Route::get('/home/driver/{id}', 'HomeController@driver');

Route::get('/home/routes', 'HomeController@routes');
Route::get('/home/route/{id}', 'HomeController@route');

Route::get('/home/tests', 'HomeController@tests');

Route::get('/home/tours', 'HomeController@tours');