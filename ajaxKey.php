<?php

// Part of a tutorial by Peter Upfold
// Released under the Modified BSD Licence:
// http://www.hybridweb.co.uk/filehive/bsdlicence

session_start(); // start a session

header("Content-type: text/plain"); 
// this is only plain text, so set the HTTP header accordingly

$names = array( // this is our array of names - feel free to change/add as required!
'a',
'b',
'c',
'd'
);

if (in_array($_GET['name'], $names)) { // if that name is in our array above

	//echo $_GET['name'];//'1'; // echo 1 (tells JavaScript we know this person)
	echo '1';
}

else { // otherwise

	//echo $_GET['name'];//echo '0'; // echo 0
	echo '0';
}


?>