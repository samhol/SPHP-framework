<?php

use Sphp\Html\Lists\Ul;

function printVar(array $var) {
  foreach ($var as $key => $value) {
    if (is_array($value)) {
      $value = var_export($value, true);
    }
    echo "<b>$key</b>: $value\n";
  }
}

echo "<pre>";
if (isset($_GET['SERVER'])) {
  echo '<h1>$_SERVER</h1>';
  printVar($_SERVER);
}
if (isset($_GET['POST'])) {
  echo '<h1>$_POST</h1>';
  printVar($_POST);
}
if (isset($_GET['GET'])) {
  echo '<h1>$_GET</h1>';
  printVar($_GET);
}
if (isset($_GET['REQUEST'])) {
  echo '<h1>$_REQUEST</h1>';
  printVar($_REQUEST);
}
if (isset($_GET['SESSION'])) {
  echo '<h1>$_SESSION</h1>';
  printVar($_SESSION);
}

if (isset($_GET['EXT'])) {
  echo '<h1>Loaded extensions</h1>';
  $ul = new Ul(get_loaded_extensions());
  $ul->printHtml();
  echo "</pre>";
}

