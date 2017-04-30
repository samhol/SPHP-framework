<?php

namespace Sphp\Html\Foundation\Sites\Grids;

use Sphp\Html\Apps\Syntaxhighlighting\CodeExampleBuilder;
use Sphp\Html\Apps\Manual\Apis;

$gridIf = Apis::apigen()->classLinker(GridInterface::class);
$htmlCont = Apis::apigen()->classLinker(\Sphp\Html\Container::class);
$grid = Apis::apigen()->classLinker(Grid::class);
$row = Apis::apigen()->classLinker(Row::class);
$rowIf = Apis::apigen()->classLinker(RowInterface::class);
$colIf = Apis::apigen()->classLinker(ColumnInterface::class);
$col = Apis::apigen()->classLinker(Column::class);
$cols = Apis::apigen()->classLinker(ColumnInterface::class, "Columns");
$gridsLnk = Apis::apigen()->namespaceLink(__NAMESPACE__);
$f_GridLink = Apis::foundation()->getComponentLink(Grid::class, "Foundation Grid layout");
echo $parsedown->text(<<<MD
##The $gridIf and its implementations

The $gridIf defines a `12-column` flexible grid that can scale out to an arbitrary 
size (defined by the max-width of the row) that's also easily nested.
		
The Grid is a **mobile-first** layout. So as a rule of thumb coding starts from small screens first, 
and larger devices will inherit those styles. Distinct features for larger screens can always be 
included when necessary.

##The horizontal $rowIf components
		
A $rowIf type defines a horizontal block containing vertical $colIf components. 
It forms a row in the $gridIf layout. This framework has alse default implementations 
for rows and columns namely $row and $col.

####Creating a $row component containing $cols with equal widths
		


* A simple way to create a $row containing $cols with equal widths is to either construct 
a $row with column contents as a parameter or set the columns similarly by calling {$rowIf->methodLink("setColumns")} method.
	* The number of the inserted columns can be `1,2,3,4,6` or `12` for equal width columns that expand the entire $row.
	* if the space used by the inserted columns is smaller than 12, the last $col will be floated to the right of the $row.
		
###An example of rows generated from arrays containing plain $col content.
MD
);
$codeExampleBuilder = new CodeExampleBuilder('Sphp/Html/Foundation/Sites/Grids/Row-array-constructor.php', false);
$rowExample1 = $codeExampleBuilder->buildAccordion();
$rowExample1
        ->addCssClass('grid-example')
        ->printHtml();
echo $parsedown->text(<<<MD
		
###An example of rows generated from arrays containing $col objects and plain content.
 		
MD
);

$rowExample2 = $codeExampleBuilder
        ->setPath('Sphp/Html/Foundation/Sites/Grids/Row-mixed-constructor.php')
        ->buildAccordion()
        ->addCssClass('grid-example')
        ->printHtml();
unset($rowExample1, $rowExample2);
echo $parsedown->text(<<<MD
		
####Incomplete $row components

In order to work around browsers' different rounding behaviors, Foundation will float the last $col in a $row to the right so the edge aligns.
If the $row doesn't have a count that adds up to 12 $cols, the last $col can be tagged with a class of end in order to override that behavior.
		
###The $gridIf and its implementations
		
The $gridIf is an implementation of Foundation 6 Grid. A Grid is a container for $rowIf type
components. A $grid component itself without any $rowIf content does not output 
any HTML into the document.
		
MD
);
$gridExample = $codeExampleBuilder
        ->setPath('Sphp/Html/Foundation/Sites/Grids/GridInterface.php')
        ->buildAccordion()
        ->addCssClass('grid-example')
        ->printHtml();
