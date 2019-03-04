<?php

namespace Sphp\Config;

$fail = function () {
  echo "<pre>";
  echo 'display_errors: ' . ini_get('display_errors') . "\n";
  echo "error_reporting: " . ini_get('error_reporting') . '</pre>';
};

PHP::ini('show_errors')
        ->set('display_errors', 1)
        ->set('error_reporting', E_ALL)
        ->execute($fail);

PHP::ini('hide_errors')
        ->set('display_errors', 0)
        ->set('error_reporting', 0)
        ->init();
$fail();
