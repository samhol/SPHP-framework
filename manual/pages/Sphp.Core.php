<?php

namespace Sphp\Core;

$ns = $api->namespaceBreadGrumbs(__NAMESPACE__);

echo $parsedown->text(<<<MD
#Core components
$ns  
  
MD
);

$load("Core-intro/Orbit-intro");
$load("Sphp.Core.Router");
$load("Sphp.Core.Configurator");

namespace Sphp\Core\ErrorHandling;
$ns = $api->namespaceBreadGrumbs(__NAMESPACE__);
echo $parsedown->text(<<<MD
##Affecting PHP's Error handling and logging behaviour
$ns

MD
);
$load("Sphp.Core.Config.ErrorHandling.ExceptionHandler");
$load("Sphp.Core.Config.ErrorHandling.ErrorHandling");
