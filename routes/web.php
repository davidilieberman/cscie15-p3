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

Route::get('/lorem/{count}', function($count) {
    $lines = file('./txt/lorem.txt');
    $output = "";
    for ($i = 0; $i <= $count; $i++) {
      $output .= "<p>".$lines[$i]."</p>";
    }
    // foreach ($lines as $line_num => $line) {
    //     $output .= "<p>".$line."</p>";
    // }
    return $output;
});
