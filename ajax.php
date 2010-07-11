<?php

session_start(); // start a session

header("Content-type: text/plain");
// this is only plain text, so set the HTTP header accordingly

$names = array( // this is our array of names - feel free to change/add as required!
  'Bob', 'Jim', 'Mark', 'Graham', 'Brian', 'Borna', 'Qpixel', 'PuzzleCompany'
);

if (in_array($_GET['name'], $names)) { // if that name is in our array above
  echo '1'; // echo 1 (tells JavaScript we know this person)
} else { // otherwise
  echo '0'; // echo 0
}
?>
