<?php

//session_start(); // start a session
ini_set('display_errors', 'On');
error_reporting(E_ALL);
header("Content-type: text/xml");

$word = $_GET['metaquery'];

$xmldoc = new DOMDocument();
if (TRUE == $xmldoc->load("words.xml")) {
  echo $xmldoc->saveXML();
}
?>
