<?php

namespace P3\Http\Controllers;

use P3\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Barryvdh\Debugbar\Facade as Debugbar;

class LoremController extends Controller {

  /**
  Given the requested number of paragraphs, return an array of
  strings representing a randomized passaged of Lorem Ipsum text. 
  */
  function buildPassage($count) {

    // Load the Lorem Ipsum source file into memory
    $lines = file('./txt/lorem.txt');

    // Initialize the output array
    $arr = array();

    // The loop counts up to the number of requested paragraphs
    for ($i = 0; $i <= $count-1; $i++) {
      $r = mt_rand(0, count($lines) - 1);
      // Extract a random paragraph from the source file.
      // The Laravel helper function array_push populates our output array
      // The Laravel helper function array_pull helps ensure we don't repeat any paragraphs in our output
      array_push($arr, array_pull($lines, $r));
    }

    return $arr;

  }

  /**
  Given a request for a passage of Lorem-Ipsum text, verify that the request provides
  a valid number of paragraphs and, if so, generate the passage.
  */
  function generate(Request $request) {

    // Validate the form input values
    $this->validate($request, [
      'loremCount' => 'required|numeric|min:1|max:99'
    ]);

    // Define the number of requested paragraphs
    $count = $request->input('loremCount');

    // Load the source file into memory
    $lines = file('./txt/lorem.txt');

    // Construct the passage
    $arr = $this->buildPassage($count);

    // Return the result, and send the user input argument back to be echoed in the form display
    return view('lorem.generate')
      ->with('loremGraphs', $arr)
      ->with('count', $count);
  }

  function index() {
    return view('lorem.generate');
  }

}
