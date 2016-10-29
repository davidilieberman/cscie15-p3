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
    return view('welcome');
});

Route::get('/lorem', 'LoremController@index')->name('lorem.index');

Route::get('/lorem/{count}', 'LoremController@generate')->name('lorem.generate');

Route::post('/lorem/generate', 'LoremController@generate')->name('lorem.generate');

Route::get('/users', 'UsersController@index')->name('users.index');

Route::get('/users/{count}/{genderFlag}', 'UsersController@generate')
  ->name('users.generate');

Route::post('/users/generate', 'UsersController@generate')->name('users.build');

// Route::get('/users/{count}', function($count) {
//     $males = file('./txt/male_names.txt');
//     $females = file('./txt/female_names.txt');
//     $surnames = file('./txt/last_names.txt');
//
//     $output = "";
//     for ($i=0; $i<$count; $i++) {
//       // Male or female_names
//       $gender = mt_rand(0,100) % 2;
//
//       // Prefix? (odds: 1 in 20)
//
//       // Pick gender-appropriate first name
//       $firstNames = $gender ? $males : $females;
//       $r = mt_rand(0, count($firstNames) - 1);
//       $output.=trim($firstNames[$r]);
//
//       // Pick last name
//       $r = mt_rand(0, count($surnames)-1);
//       $output.=trim($surnames[$r]);
//
//       // Suffix? (odd: 1 in 50);
//
//       // Next
//       $output.="<br/>";
//
//     }
//
//     return $output;
//
// });
