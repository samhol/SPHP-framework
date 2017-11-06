<?php

namespace Sphp\Html\Foundation\Sites\Media;

use Sphp\Html\Apps\Manual\Apis;
use Sphp\Html\Foundation\Sites\Grids\BlockGrid;

$ns = \Sphp\Manual\api()->namespaceBreadGrumbs(__NAMESPACE__);

$flexes = (new BlockGrid(['small-up-1', 'large-up-2']))
        ->append(ResponsiveEmbed::youtube("w-I6XTVZXww")->setAspectRatio('panorama'))
        ->append(ResponsiveEmbed::youtube("0mgnf6t9VEc")->setAspectRatio('panorama'));
echo <<<MD
##Foundation Media components:

$ns
 
<div class="example-area">
$flexes
</div>
MD
;
