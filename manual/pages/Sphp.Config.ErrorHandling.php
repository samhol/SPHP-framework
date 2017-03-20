<?php

namespace Sphp\Config\ErrorHandling;

$ns = $api->namespaceBreadGrumbs(__NAMESPACE__);
echo $parsedown->text(<<<MD
##Affecting PHP's Error handling and error logging behaviour
$ns

MD
);
$load("Sphp.Config.ErrorHandling.ExceptionHandler");
$load("Sphp.Config.ErrorHandling.ErrorHandling");
