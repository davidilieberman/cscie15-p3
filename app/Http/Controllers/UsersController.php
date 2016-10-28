<?php

namespace P3\Http\Controllers;

use P3\Http\Controllers\Controller;

use Barryvdh\Debugbar\Facade as Debugbar;

class UsersController extends Controller {

  public $neutralPrefixes = array("Dr. ", "Prof. ");

  private $femalePrefixes  = array("Mrs. ", "Ms. ");

  private $malePrefixes = array("Mr. ");

  private $neutralSuffixes = array(", Esq.", ", Ph.D.", ", M.D.");

  private $maleSuffixes = array(", Jr.", " III", " IV");

  private $femaleSuffixes = array();

  function buildUser($prefixes, $firstNames, $lastNames, $suffixes) {
    $output = "";
    $output = $this->decorator($prefixes, 20, $output);
    $output .= trim($this->component($firstNames))." ";
    $output .= trim($this->component($lastNames));
    return $this->decorator($suffixes, 50, $output);
  }

  function component($arr) {
    return $arr[mt_rand(0, count($arr)-1)];
  }

  function decorator($decorators, $odds, $output) {
    if (mt_rand(0, $odds) <= 3) {
      $output .= $this->component($decorators);
    }
    return $output;
  }

  function generate($count, $genderFlag) {

    $males = file('./txt/male_names.txt');
    $females = file('./txt/female_names.txt');
    $surnames = file('./txt/last_names.txt');

    $names = array();

    for ($i=0; $i<$count; $i++) {

      $gender = ($genderFlag < 2 ? $genderFlag : mt_rand(0,100) % 2);
      $prefixes = array_collapse([$this->neutralPrefixes, ($gender ? $this->malePrefixes : $this->femalePrefixes)]);
      $firstNames = $gender ? $males : $females;
      $suffixes = array_collapse([$this->neutralSuffixes, ($gender ? $this->maleSuffixes : $this->femaleSuffixes)]);
      array_push($names, $this->buildUser($prefixes, $firstNames, $surnames, $suffixes));

    }

    return view('users.generate')->with('names', $names);
  }
}
