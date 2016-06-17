<?php

namespace Sphp\Html\Foundation\F6\Core;

include_once "../settings.php";

$panels = [];
$get = filter_input_array(\INPUT_GET, FILTER_SANITIZE_STRING);
$post = filter_input_array(\INPUT_POST, FILTER_SANITIZE_STRING);
if (is_array($get) && count($get) > 0) {
  echo "<h6>Form submission <code>GET</code> data:</h6><pre>" . print_r($get, true) . "</pre>";
}
else if (is_array($post) && count($post) > 0) {
  echo "<h6>Form submission data:</h6><pre>" . print_r($post, true) . "</pre>";
} else {
  echo "<h6>Form submission data:</h6><pre>No submission data found!</pre>";
}
/*echo "<pre>";
print_r($_GET);
print_r($_POST);
echo "</pre>";*/