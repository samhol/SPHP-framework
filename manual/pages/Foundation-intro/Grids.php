<?php

namespace Sphp\Html\Foundation\F6\Grids;

use Sphp\Html\Apps\Manual\Apis;

$ns = Apis::apigen()->namespaceBreadGrumbs(__NAMESPACE__);
$grid = Apis::apigen()->classLinker(GridInterface::class);
$row = Apis::apigen()->classLinker(Row::class);
$column = Apis::apigen()->classLinker(Column::class);
$blockGrid = Apis::apigen()->classLinker(BlockGrid::class);
echo <<<MD
##Foundation 6 Grid components:
$ns
This namespace includes for example Foundation based multi-device nestable 12-column $grid implementation in object oriented PHP and a
Foundation $blockGrid to evenly split contents of a list within the grid...
        
###$grid example:
<div class="example-area grid-example">
MD
;

include(EXAMPLE_DIR . 'Sphp/Html/Foundation/F6/Grids/Row-array-constructor.php');
echo "</div>";

