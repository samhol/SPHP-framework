<?php

namespace Sphp\Core\Config;

$f = function () {
  echo 'date.timezone = ' . ini_get('date.timezone') . "\n";
};

$f();
$ini = (new Ini())
        ->set('date.timezone', 'Europe/Rome')
        ->init();
$f();
$ini->reset();
$f();
$ini->execute($f);
$ini->reset();
$f();

?>