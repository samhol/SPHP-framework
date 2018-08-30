<?php

namespace Sphp\Config;

$f = function () {
  echo $foo;
  echo $php_errormsg;
};

$f();
PHP::ini('hidden')
        ->set('track_errors', 'true')->init();
PHP::ini('hidden')->execute($f);
$f();
