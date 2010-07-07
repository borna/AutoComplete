<?php

// Part of a tutorial by Peter Upfold
// Released under the Modified BSD Licence:
// http://www.hybridweb.co.uk/filehive/bsdlicence

session_start(); // start a session

header("Content-type: text/plain"); 
// this is only plain text, so set the HTTP header accordingly

$names = array( // this is our array of names - feel free to change/add as required!
'Bob',
'Jim',
'Mark',
'Graham'
);

if (in_array($_GET['name'], $names)) { // if that name is in our array above

	echo '1'; // echo 1 (tells JavaScript we know this person)

}

else { // otherwise

	echo '0'; // echo 0

}


?>