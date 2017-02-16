<?php

namespace Sphp\Core\Config;

$php1 = (new PHPConfig())
        ->setErrorReporting(E_ALL);
var_dump(
        error_reporting()
);
$php2 = (new PHPConfig())
        ->setErrorReporting(0);
var_dump(
        error_reporting()
);
echo $missingVar; // variable is not set

$php1->init();
var_dump(
        error_reporting()
);

$efw;

