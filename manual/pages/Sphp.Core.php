<?php

namespace Sphp\Core;

$ns = $api->namespaceBreadGrumbs(__NAMESPACE__);

echo $parsedown->text(<<<MD
#Core components
$ns  
  
MD
);

$load("Core-intro/Orbit-intro.php");
$load("Sphp.Core.PathFinder.php");
$load("Sphp.Core.Configurator.php");

namespace Sphp\Core\ErrorHandling;
$ns = $api->namespaceBreadGrumbs(__NAMESPACE__);
echo $parsedown->text(<<<MD
##Affecting PHP's Error handling and logging behaviour
$ns

MD
);
$load("Sphp.Core.ExceptionHandler.php");
$load("Sphp.Core.ErrorHandling.php");
