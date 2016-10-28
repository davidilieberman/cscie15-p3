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

  function generate($count) {

    $males = file('./txt/male_names.txt');
    $females = file('./txt/female_names.txt');
    $surnames = file('./txt/last_names.txt');

    $output = "";
    for ($i=0; $i<$count; $i++) {

      // Male or female_names
      $gender = mt_rand(0,100) % 2;

      // Prefix? (odds: 3 in 20)
      if (mt_rand(1,20) <= 3) {
        $prefixes = array_collapse([$this->neutralPrefixes, ($gender ? $this->malePrefixes : $this->femalePrefixes)]);
        $r = mt_rand(0, count($prefixes)-1);
        $output .= $prefixes[$r];
      }

      // Pick gender-appropriate first name
      $firstNames = $gender ? $males : $females;
      $r = mt_rand(0, count($firstNames) - 1);
      $output.=trim($firstNames[$r]);

      // Pick last name
      $r = mt_rand(0, count($surnames)-1);
      $output.=trim($surnames[$r]);

      // Suffix? (odds: 3 in 50);
      if (mt_rand(1,50) <= 3) {
        $suffixes = array_collapse([$this->neutralSuffixes, ($gender ? $this->maleSuffixes : $this->femaleSuffixes)]);
        $r = mt_rand(0, count($suffixes) - 1);
        $output.=$suffixes[$r];
      }

      // Next
      $output.="<br/>";

    }
    return $output;
  }
}
