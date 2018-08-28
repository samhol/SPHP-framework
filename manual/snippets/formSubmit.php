<?php

//namespace Sphp\Html\Foundation\Sites\Core;

require_once "../settings.php";

function arrayPrinter(array $array) {
  $output = new \Sphp\Html\Lists\Ul();
  foreach ($array as $key => $value) {
    if (is_array($value)) {
      $value = arrayPrinter($value);
    } else {
      $value = "<samp>$value</samp>";
    }
    $output->append("<strong>$key</strong> => $value");
  }
  return $output;
}

$post = filter_input_array(\INPUT_POST, FILTER_SANITIZE_STRING);
if (is_array($post) && count($post) > 0) {
  echo "<h6>Form submission data:</h6><pre>" . arrayPrinter($post) . "</pre>";
} else {
  echo "<h6>Form submission data:</h6><pre>No submission data found!</pre>";
}
/*echo "<pre>";
print_r($_GET);
print_r($_POST);
echo "</pre>";*/
