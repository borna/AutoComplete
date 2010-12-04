<?php
ini_set('display_errors', 'On');
error_reporting(E_ALL);
session_start();
header("Content-type: text/plain");

foreach ($_GET as $key => $value) {
  echo '<p>'.$key.'=>'.$value.'</p>';
}
foreach ($_POST as $key => $value) {
  echo '<p>'.$key.'=>'.$value.'</p>';
}
foreach ($_FILES as $key => $value) {
  echo '<p>'.$key.'=>'.$value.'</p>';
}
foreach ($_SERVER as $key => $value) {
  echo '<p>'.$key.'=>'.$value.'</p>';
}
foreach ($_ENV as $key => $value) {
  echo '<p>'.$key.'=>'.$value.'</p>';
}

if (isset($_GET['query'])) {
  $query = $_GET['query'];
  $file_handle = fopen('notable-words.txt','a') or die("can't open file for read/write");
  rewind($file_handle);
  while (!feof($file_handle)) {
    $lineword = fgets($file_handle, 1024);
    if ($lineword == $query) {
      break;
    }
  }

  if (feof($file_handle)) {
    rewind($file_handle);
    while (!feof($file_handle)) {
      $line = fgets($file_handle, 1024);
      echo "<p>".$line."</p>";
    }
  } else {
    echo "<p>".$query." is found in the file </p>";
  }
  fclose($file_handle) or die("can't close:".$php_errormsg);
}

?>
