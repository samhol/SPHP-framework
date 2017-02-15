<?php

namespace Sphp\Core\Config;
if (date_default_timezone_get()) {
    echo 'date_default_timezone_set: ' . date_default_timezone_get() . '<br />';
}
$time = function () {
  echo date('h:i:s T') . "\n";
};
$time();

$ini = (new Ini())
        ->set('date.timezone', 'Pacific/Honolulu')
        ->execute($time);

$time();
?>
