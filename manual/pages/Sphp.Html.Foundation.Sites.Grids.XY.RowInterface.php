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

####Creating a Row from an array of column contents
	
* A simple way to create a Row containing Columns with equal widths is to either construct 
a Row with column contents as its first parameter or set the columns similarly by calling {$rowIf->methodLink("setColumns")} method.
	* The number of the inserted columns can be `1,2,3,4,6` or `12` for equal width columns that expand the entire Row.
	* if the space used by the inserted columns is smaller than 12, the last $col will be floated to the right of the Row.
		
###An example of rows generated from arrays containing plain $col content.
MD
);
Manual\example('Sphp/Html/Foundation/Sites/Grids/XY/Row_fromArray.php')
        ->buildAccordion()
        ->addCssClass('grid-example')
        ->printHtml();

Manual\parseDown(<<<MD

###An example of rows generated from arrays containing $col objects and plain content.

MD
);

Manual\example('Sphp/Html/Foundation/Sites/Grids/XY/Row-mixed-constructor.php')
        ->buildAccordion()
        ->addCssClass('grid-example')
        ->printHtml();
