<?php

namespace P3\Http\Controllers;

use P3\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Barryvdh\Debugbar\Facade as Debugbar;
use phootwork\collection\ArrayList as ArrayList;

class UsersController extends Controller {

  /* These member variables define the prefixes and suffixes that
      may be arbitrarily assigned to some of the generated users. */

  private $neutralPrefixes = array("Dr. ", "Prof. ");

  private $femalePrefixes  = array("Mrs. ", "Ms. ");

  private $malePrefixes = array("Mr. ");

  private $neutralSuffixes = array(", Esq.", ", Ph.D.", ", M.D.");

  private $maleSuffixes = array(", Jr.", " III", " IV");

  private $femaleSuffixes = array();

  /**
  Given gender-specific arrays of prefixes, first names, and suffixes,
  and an array of last names, create a new user.
  */
  function buildUserObj($prefixes, $firstNames, $lastNames, $suffixes) {
    $u = array();
    $u['prefix'] = $this->decorator($prefixes, 20, "");
    $u['firstName'] = $this->component($firstNames);
    $u['lastName'] = $this->component($lastNames);
    $u['suffix'] = $this->decorator($suffixes, 50, "");
    return $u;
  }

  /**
    Return an arbitraily selected element from the specified array.
  */
  function component($arr) {
    return $arr[mt_rand(0, count($arr)-1)];
  }

  /**
    Given an array of decorators (prefixes or suffixes) and the three of X
    odds that one should be extracted, play the odds and, if the odds are
    favorable, extract a decorator to append to the submitted output string.
  */
  function decorator($decorators, $odds, $output) {
    if (mt_rand(0, $odds) <= 3) {
      $output .= $this->component($decorators);
    }
    return $output;
  }

  function userObjToString($user) {
    return trim($user["prefix"])." "
            .trim($user["firstName"])." "
            .trim($user["lastName"])
            .$user["suffix"];
  }

  function usersListToArray($users) {
    $arr = array();
    foreach ($users as $user) {
      array_push($arr, $this->userObjToString($user));
    }
    return $arr;
  }

  /**
  Generate an array of users in the number specified as $count and
  of the gender specified by $genderFlag.

  $genderFlag values:
  0 = Female users only
  1 = Male users only
  2 = Randomized array of male and female users
  */
  function generateUsers($count, $genderFlag) {

    Debugbar::info("UsersController.generate: rec'd genderFlag " .$genderFlag);

    // Load our lists of name components
    $males = file('./txt/male_names.txt');
    $females = file('./txt/female_names.txt');
    $surnames = file('./txt/last_names.txt');

    // Instantiate the array of names we'll create
    $names = array();
    $users = new ArrayList();

    // Iterate the user creation process for the requested number of times
    for ($i=0; $i<$count; $i++) {

      // For each user, define a gender
      $gender = ($genderFlag < 2 ? $genderFlag : mt_rand(0,100) % 2);

      // Now that we have a gender, gather the appropriate source lists
      // - merge the gender neutral prefixes with those peculiar to the gender
      $prefixes = array_collapse([$this->neutralPrefixes,
        ($gender ? $this->malePrefixes : $this->femalePrefixes)]);

      // - pick the gender-appropriate list of first names
      $firstNames = $gender ? $males : $females;

      // - merge the gender neutral suffixes with those peculiar to the gender
      $suffixes = array_collapse([$this->neutralSuffixes,
        ($gender ? $this->maleSuffixes : $this->femaleSuffixes)]);

      // Create the user and add it to the list
      $users->add($this->buildUserObj($prefixes, $firstNames, $surnames, $suffixes));

    }

    // Sort users on last name, first name
    $sortedUsers = $users->sort(function($a, $b) {
      if ($a["lastName"] == $b["lastName"]) {
        if ($a["firstName"] == $b["firstName"]) {
          return 0;
        }
        return ($a["firstName"] < $b["firstName"]) ? -1 : 1;
      }
      return ($a["lastName"] < $b["lastName"]) ? -1 : 1;
    });


    // Convert the list of users to an array of strings
    $arr = $this->usersListToArray($sortedUsers);

    // Pass the list of generated users and the form input values to the
    // template
    return view('users.generate')
      ->with('names', $arr)
      ->with('count', $count)
      ->with('genderOptions', $this->genderOptions($genderFlag));
  }

  /**
   Create an associative array reflecting the properties of a gender option
   */
  function genderOption($label, $value, $selIdx) {
    return array('label' => $label, 'value' => $value, 'selected' => ($selIdx == $value));
  }

  /**
  Create an array of associative arrays to support rendering the gender
  options in the user creation form
  */
  function genderOptions($selIdx) {
    Debugbar::info("UsersController.genderOptions: Received selIdx ". $selIdx);
    $opts = array();
    array_push($opts, $this->genderOption('Both', 2, $selIdx));
    array_push($opts, $this->genderOption('Male', 1, $selIdx));
    array_push($opts, $this->genderOption('Female', 0, $selIdx));
    return $opts;
  }

  /**
  Process a submitted request to generate users.
  */
  function generate(Request $request) {

    $this->validate($request, [
      'count' => 'required|numeric|min:1|max:99',
      'genderFlag' => 'required|numeric|min:0|max:2'
    ]);

    $count = $request->input('count');
    $genderFlag = $request->input('genderFlag');

    return $this->generateUsers($count, $genderFlag);
  }

  /**
  Show the user generation form.
  */
  function index() {
    return view('users.generate')
      ->with('genderOptions', $this->genderOptions(2));
  }
}
