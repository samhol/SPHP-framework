<?php

namespace Sphp\Html\Foundation;

use Sphp\Html\Foundation\Sites\Grids\Grid;
use Sphp\Html\Foundation\Sites\Grids\Row;
use Sphp\Html\Foundation\Sites\Grids\Column;

$grid = $api->classLinker(Grid::class);
$row = $api->classLinker(Row::class);
$col = $api->classLinker(Column::class);
$cols = $api->classLinker(Column::class, "Columns");
//$ns = $api->namespaceLink(__NAMESPACE__);
$ns = $api->namespaceBreadGrumbs(__NAMESPACE__);
$f_GridLink = $foundation->getComponentLink(Grid::class, "Foundation Grid layout");
echo $parsedown->text(<<<MD
#Foundation front-end framework
        
$ns

Foundation framework is included in SPHP and therefore also all of Foundation 
clientside properties are available. Here is a small collection of features available.
MD
);
$load("Sphp.Html.Foundation-orbit-intro.php");
