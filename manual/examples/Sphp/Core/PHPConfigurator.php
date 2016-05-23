<?php

namespace Sphp\Core;

$php1 = (new PHPConfiguration())
        ->setErrorReporting(E_ALL)
        ->iniSet('display_errors', '1');
var_dump(
        error_reporting(),
        ini_get('display_errors')
);
$php2 = (new PHPConfiguration())
        ->setErrorReporting(0)
        ->iniSet('display_errors', '0');
var_dump(
        error_reporting(),
        ini_get('display_errors')
);
echo $missingVar; // variable is not set

$php1->init();
var_dump(
        error_reporting(),
        ini_get('display_errors')
);

