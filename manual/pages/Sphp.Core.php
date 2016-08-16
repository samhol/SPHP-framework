<?php

namespace Sphp\Core;

$ns = $api->namespaceBreadGrumbs(__NAMESPACE__);

echo $parsedown->text(<<<MD
#Core components
$ns      
Core components are a collection of miscellaneous classes. These classes can be groupped into:

 1. Configuration and error handling
 2. Variable manipulation
 3. Human language translation
 4. Event dispatching
        
MD
);

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
