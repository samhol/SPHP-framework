<?php

namespace Sphp\Stdlib;

use Sphp\Html\Apps\Manual\Apis;

$ns = Apis::sami()->namespaceBreadGrumbs(__NAMESPACE__);

\Sphp\Manual\parseDown(<<<MD
#Standard library components
$ns  
  
MD
);

\Sphp\Manual\loadPage('Core-intro/Orbit-intro');
\Sphp\Manual\loadPage('Sphp.Core.Router');

