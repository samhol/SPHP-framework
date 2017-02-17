<?php

namespace Sphp\Core\Config;

$honolulu = (new PHPConfig())
        ->setDefaultTimezone('Pacific/Honolulu')
        ->init();
echo "Current time: " . date('H:i:s T') . "\n";

$helsinki = (new PHPConfig())
        ->setDefaultTimezone('Europe/Helsinki')
        ->init();
echo "Current time: " . date('H:i:s T');
?>