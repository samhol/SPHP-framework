<?php

namespace Sphp\Html\Foundation\Sites\Media;

use Sphp\Html\Apps\Manual\Apis;

$ns = Apis::apigen()->namespaceBreadGrumbs(__NAMESPACE__);

use Sphp\Html\Foundation\Sites\Grids\BlockGrid;

$flexes = (new BlockGrid(null, 1, false, 2))
        ->append(Flex::youtube("w-I6XTVZXww")->setWidescreen())
        ->append(Flex::dailymotion("x2p4pkp")->setWidescreen());
$manLink = new \Sphp\Html\Foundation\Sites\Buttons\HyperlinkButton("?page=Sphp.Html.Foundation.Sites.Media", "Manual page", "_self");
echo <<<MD
##Foundation Media components:$manLink

$ns
 
<div class="example-area">
$flexes
</div>
MD
;
