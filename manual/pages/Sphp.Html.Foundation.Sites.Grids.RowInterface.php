<?php

namespace Sphp\Html\Foundation\Sites\Grids;

use Sphp\Html\Apps\Syntaxhighlighting\CodeExampleBuilder;
use Sphp\Html\Apps\Manual\Apis;

$gridIf = \Sphp\Manual\api()->classLinker(GridInterface::class);
$htmlCont = \Sphp\Manual\api()->classLinker(\Sphp\Html\Container::class);
//$grid = \Sphp\Manual\api()->classLinker(Grid::class);
$row = \Sphp\Manual\api()->classLinker(Row::class);
$rowIf = \Sphp\Manual\api()->classLinker(RowInterface::class);
$colIf = \Sphp\Manual\api()->classLinker(ColumnInterface::class);
$col = \Sphp\Manual\api()->classLinker(Column::class);
$cols = \Sphp\Manual\api()->classLinker(ColumnInterface::class, "Columns");

$codeExampleBuilder = new CodeExampleBuilder('Sphp/Html/Foundation/Sites/Grids/Grid_fromArray.php', 'html5');


\Sphp\Manual\parseDown(<<<MD
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
$codeExampleBuilder->setPath('Sphp/Html/Foundation/Sites/Grids/Row_fromArray.php')
        ->buildAccordion()
        ->addCssClass('grid-example')
        ->printHtml();

\Sphp\Manual\parseDown(<<<MD
		
###An example of rows generated from arrays containing $col objects and plain content.
 		
MD
);

$codeExampleBuilder->setPath('Sphp/Html/Foundation/Sites/Grids/Row-mixed-constructor.php')
        ->buildAccordion()
        ->addCssClass('grid-example')
        ->printHtml();

\Sphp\Manual\parseDown(<<<MD
		
####Incomplete $row components

In order to work around browsers' different rounding behaviors, Foundation will float the last Column in a Row to the right so the edge aligns.
If the Row doesn't have a count that adds up to 12 Columns, the last column object can be tagged with a class of end in order to override that behavior.

MD
);

