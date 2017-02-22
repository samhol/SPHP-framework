<?php

namespace Sphp\Config\ErrorHandling;

$ns = $api->namespaceBreadGrumbs(__NAMESPACE__);
echo $parsedown->text(<<<MD
##Affecting PHP's Error handling and error logging behaviour
$ns

MD
);
$load("Sphp.Core.Config.ErrorHandling.ExceptionHandler");
$load("Sphp.Core.Config.ErrorHandling.ErrorHandling");
