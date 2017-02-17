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

