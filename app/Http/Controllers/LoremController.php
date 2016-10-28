<?php

namespace P3\Http\Controllers;

use P3\Http\Controllers\Controller;

class LoremController extends Controller {

  function generate($count) {
    $lines = file('./txt/lorem.txt');
    $output = "";
    for ($i = 0; $i <= $count; $i++) {
      $output .= "<p>".$lines[$i]."</p>";
    }

    return $output;
  }

}
