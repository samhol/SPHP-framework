<?php

namespace Sphp\Config;

$f = function () {
  echo "Current date and time:\t" . date('Y-m-d H:i:s T') . "\n";
};

$f();
PHP::ini('date.timezone.Rome')
        ->set('date.timezone', 'Europe/Rome')
        ->init();
PHP::ini('date.timezone.Rome')->execute($f);
$f();
