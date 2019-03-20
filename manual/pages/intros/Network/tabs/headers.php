<?php

namespace Sphp\Html\Media\Multimedia;

use Sphp\Html\Media\Multimedia\VideoJs;
use Sphp\Html\Foundation\Sites\Grids\BlockGrid;

$ns = \Sphp\Manual\api()->namespaceBreadGrumbs(__NAMESPACE__);
$videoJs = \Sphp\Manual\api()->classLinker(VideoJs::class);
echo <<<MD
##`HTML` Media components

$ns
        
This namespace contains components for handling different media types
using the tools provided by Foundation framework.

###$videoJs example:
 
MD
;

