<?php

namespace Sphp\Html\Foundation\Sites\Grids;

use Sphp\Html\Apps\Manual\Apis;

$ns = Apis::sami()->namespaceBreadGrumbs(__NAMESPACE__);
$grid = Apis::sami()->classLinker(GridInterface::class);
$row = Apis::sami()->classLinker(Row::class);
$column = Apis::sami()->classLinker(Column::class);
$blockGrid = Apis::sami()->classLinker(BlockGrid::class);
echo <<<MD
##Foundation Grid components:
$ns
<div class="example-area grid-example">
MD
;

include('Sphp/Html/Foundation/Sites/Grids/GridInterface.php');
echo "</div>";

