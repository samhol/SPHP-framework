<?php

namespace Sphp\Config;

$f = function () {
  echo $foo;
};

$f();
PHP::ini('hidden')
        ->set('display_errors', '0')->init();
PHP::ini('hidden')->execute($f);
$f();
