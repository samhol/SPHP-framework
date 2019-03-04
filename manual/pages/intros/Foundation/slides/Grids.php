<?php

namespace Sphp\Html\Foundation\Sites\Grids;


$ns = \Sphp\Manual\api()->namespaceBreadGrumbs(__NAMESPACE__);
$grid = \Sphp\Manual\api()->classLinker(Grid::class);
$row = \Sphp\Manual\api()->classLinker(BasicRow::class);
$column = \Sphp\Manual\api()->classLinker(ContainerCell::class);
$blockGrid = \Sphp\Manual\api()->classLinker(BlockGrid::class);
echo <<<MD
##Foundation Grid components:
$ns
<div class="example-area grid-example">
MD
;

//include('Sphp/Html/Foundation/Sites/Grids/XY/Row.php');
echo "</div>";

