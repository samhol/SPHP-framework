<?php

namespace Sphp\Html\Foundation\Sites\Grids;

use Sphp\Manual;

$rowIf = Manual\api()->classLinker(RowInterface::class);
$colIf = Manual\api()->classLinker(Column::class);

Manual\md(<<<MD
##The $colIf <small>and its implementations</small>
		
A $colIf defines a single column of a $rowIf in a Grid layout.

MD
);
Manual\example('Sphp/Html/Foundation/Sites/Grids/XY/Column.php')
        ->buildAccordion()
        ->addCssClass('grid-example')
        ->printHtml();


