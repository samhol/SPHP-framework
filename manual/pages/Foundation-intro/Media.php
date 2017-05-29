<?php

namespace Sphp\Html\Foundation\Sites\Media;

use Sphp\Html\Apps\Manual\Apis;

$ns = Apis::sami()->namespaceBreadGrumbs(__NAMESPACE__);

use Sphp\Html\Foundation\Sites\Grids\BlockGrid;

$flexes = (new BlockGrid(null, ['small-up-1', 'large-up-2']))
        ->append(ResponsiveEmbed::youtube("w-I6XTVZXww")->setAspectRatio('panorama'))
        ->append(ResponsiveEmbed::dailymotion("x2p4pkp")->setAspectRatio('panorama'));
echo <<<MD
##Foundation Media components:

$ns
 
<div class="example-area">
$flexes
</div>
MD
;
