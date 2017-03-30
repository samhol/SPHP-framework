<?php

namespace Sphp\Html\Foundation\Sites\Grids;

use Sphp\Html\Apps\Manual\Apis;

$ns = Apis::apigen()->namespaceBreadGrumbs(__NAMESPACE__);
$grid = Apis::apigen()->classLinker(GridInterface::class);
$row = Apis::apigen()->classLinker(Row::class);
$column = Apis::apigen()->classLinker(Column::class);
$blockGrid = Apis::apigen()->classLinker(BlockGrid::class);
echo <<<MD
##Foundation Grid components:
$ns
<div class="example-area grid-example">
MD
;

include('Sphp/Html/Foundation/F6/Grids/GridInterface.php');
echo "</div>";

