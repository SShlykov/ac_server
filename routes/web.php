<?php

Route::get('/', function () {
    if (Auth::user()) {
        return redirect('/home');
    }
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
