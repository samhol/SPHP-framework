<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);
require_once('../settings.php');
require_once ('../appConf.php');
$headers = new \Sphp\Network\Headers\Headers();
$headers->appendContentType('text/html; charset=UTF-8');
$headers->save();
//echo '<pre>';
//print_r($_GET);
//echo '</pre>';

if (filter_has_var(INPUT_GET, 'php')) {
  $value = filter_input(INPUT_GET, 'php', FILTER_SANITIZE_STRING);
  try {

    $titler = $api($value);
    echo $titler->getDefaultTitleContent();
  } catch (Throwable $ex) {
    echo $ex->getMessage();
    echo "<br>Error value($value)!!!";
  }
}
if (filter_has_var(INPUT_GET, 'php-ext')) {
  $value = filter_input(INPUT_GET, 'php-ext', FILTER_SANITIZE_STRING);
  $type = filter_input(INPUT_GET, 'link-type', FILTER_VALIDATE_INT);
  try {
    var_dump($type);
    $titler = $api->extensionLink($value);
    echo $titler->getDefaultTitleContent($type);
    echo"<br>";
    //print_r($titler->itemDataToArray());
    echo json_encode($titler->itemDataToArray($type));
  } catch (Throwable $ex) {
    echo $ex->getMessage();
    echo "<br>Error value($value)!!!";
  }
}