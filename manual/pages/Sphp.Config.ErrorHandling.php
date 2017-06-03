<?php

namespace Sphp\Config\ErrorHandling;

$ns = $api->namespaceBreadGrumbs(__NAMESPACE__);
echo $parsedown->text(<<<MD
##Affecting PHP's Error handling behaviour
$ns

MD
);
$load('Sphp.Config.ErrorHandling.ThrowableHandler');
$load('Sphp.Config.ErrorHandling.ErrorHandling');
