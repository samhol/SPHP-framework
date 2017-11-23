<?php

namespace Sphp\Html\Foundation\Sites\Grids\XY;

use Sphp\Manual;

$gridIf = Manual\api()->classLinker(GridInterface::class);
$htmlCont = Manual\api()->classLinker(\Sphp\Html\Container::class);
//$grid = \Sphp\Manual\api()->classLinker(Grid::class);
$row = Manual\api()->classLinker(Row::class);
$rowIf = Manual\api()->classLinker(RowInterface::class);
$colIf = Manual\api()->classLinker(ColumnInterface::class);
$col = Manual\api()->classLinker(Column::class);
$cols = Manual\api()->classLinker(ColumnInterface::class, 'Columns');

Manual\parseDown(<<<MD
##The $rowIf <small>and its implementations</small>

A $rowIf defines a horizontal block containing vertical $colIf components. 
It forms a single row in a $gridIf layout, but it can be used as a individual component also.

MD
);
Manual\example('Sphp/Html/Foundation/Sites/Grids/XY/Row.php')
        ->buildAccordion()
        ->addCssClass('grid-example')
        ->printHtml();
