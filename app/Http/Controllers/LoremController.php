<?php

namespace P3\Http\Controllers;

use P3\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Barryvdh\Debugbar\Facade as Debugbar;

class LoremController extends Controller {

  function generate(Request $request) {

    $this->validate($request, [
      'loremCount' => 'required|numeric|min:1|max:99'
    ]);

    $count = $request->input('loremCount');
    $lines = file('./txt/lorem.txt');

    $arr = array();
    //$output = "";
    for ($i = 0; $i <= $count-1; $i++) {
      //$output .= "<p>".$lines[$i]."</p>";
      array_push($arr, $lines[$i]);
    }

    return view('lorem.generate')
      ->with('loremGraphs', $arr)
      ->with('count', $count);
  }

  function index() {
    return view('lorem.generate');
  }

}
