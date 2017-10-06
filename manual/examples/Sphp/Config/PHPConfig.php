<?php

namespace Sphp\Config;

$honolulu = (new PHPConfig())
        ->setDefaultTimezone('Pacific/Honolulu')
        ->init();
echo "Current time in Honolulu Hawaii:\t" . date('H:i:s T') . "\n";

$helsinki = (new PHPConfig())
        ->setDefaultTimezone('Europe/Helsinki')
        ->init();
echo "Current time in Helsinki Finland:\t" . date('H:i:s T');
