<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/

Route::get('/', function () {
    return view('home.index');
});

Route::get('/lorem', 'LoremController@index')->name('lorem.index');

Route::post('/lorem', 'LoremController@generate')->name('lorem.generate');

Route::get('/users', 'UsersController@index')->name('users.index');

Route::post('/users', 'UsersController@generate')->name('users.build');
