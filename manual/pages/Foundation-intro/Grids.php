<?php

namespace Sphp\Html\Foundation\Sites\Grids;

use Sphp\Html\Apps\Manual\Apis;

$ns = \Sphp\Manual\api()->namespaceBreadGrumbs(__NAMESPACE__);
$grid = \Sphp\Manual\api()->classLinker(GridInterface::class);
$row = \Sphp\Manual\api()->classLinker(Row::class);
$column = \Sphp\Manual\api()->classLinker(Column::class);
$blockGrid = \Sphp\Manual\api()->classLinker(BlockGrid::class);
echo <<<MD
##Foundation Grid components:
$ns
<div class="example-area grid-example">
MD
;

include('Sphp/Html/Foundation/Sites/Grids/GridInterface.php');
echo "</div>";

