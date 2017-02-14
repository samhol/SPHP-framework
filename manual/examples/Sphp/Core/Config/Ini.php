<?php

namespace Sphp\Core\Config;

echo 'date.timezone = ' . ini_get('date.timezone') . "\n";

$ini = (new Ini())
        ->set('date.timezone', 'Europe/Rome')
        ->init();
echo 'date.timezone = ' . ini_get('date.timezone') . "\n";

$ini->reset();
echo 'date.timezone = ' . ini_get('date.timezone') . "\n";
?>
