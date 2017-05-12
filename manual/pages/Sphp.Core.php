<?php

namespace Sphp\Stdlib;

use Sphp\Html\Apps\Manual\Apis;

$ns = Apis::sami()->namespaceBreadGrumbs(__NAMESPACE__);

echo $parsedown->text(<<<MD
#Standard library components
$ns  
  
MD
);

$load('Core-intro/Orbit-intro');
$load('Sphp.Core.Router');

