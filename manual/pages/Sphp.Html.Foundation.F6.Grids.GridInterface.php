<?php

namespace Sphp\Html\Foundation\Sites\Grids;

use Sphp\Html\Foundation\Sites\Containers\Accordions\CodeExampleAccordion;

$gridIf = $api->classLinker(GridInterface::class);
$htmlCont = $api->classLinker(\Sphp\Html\Container::class);
$grid = $api->classLinker(Grid::class);
$row = $api->classLinker(Row::class);
$rowIf = $api->classLinker(RowInterface::class);
$colIf = $api->classLinker(ColumnInterface::class);
$col = $api->classLinker(Column::class);
$cols = $api->classLinker(ColumnInterface::class, "Columns");
$gridsLnk = $api->namespaceLink(__NAMESPACE__);
$f_GridLink = $foundation->getComponentLink(Grid::class, "Foundation Grid layout");
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
a $row with column contents as a parameter or set the columns similarly by calling {$rowIf->method("setColumns")} method.
	* The number of the inserted columns can be `1,2,3,4,6` or `12` for equal width columns that expand the entire $row.
	* if the space used by the inserted columns is smaller than 12, the last $col will be floated to the right of the $row.
		
###An example of rows generated from arrays containing plain $col content.
MD
);
$rowExample1 =  new CodeExampleAccordion(EXAMPLE_DIR . 'Sphp/Html/Foundation/F6/Grids/Row-array-constructor.php', false);
$rowExample1
        ->getOutputPane()
        ->addCssClass("grid-example");
$rowExample1->printHtml();
echo $parsedown->text(<<<MD
		
###An example of rows generated from arrays containing $col objects and plain content.
 		
MD
);       

$rowExample2 =  new CodeExampleAccordion(EXAMPLE_DIR . 'Sphp/Html/Foundation/F6/Grids/Row-mixed-constructor.php');
$rowExample2
        ->getOutputPane()
        ->addCssClass("grid-example");
$rowExample2->printHtml();
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
$gridExample = new CodeExampleAccordion();
$gridExample->fromFile(EXAMPLE_DIR . 'Sphp/Html/Foundation/F6/Grids/GridInterface.php');
$gridExample
        ->getOutputPane()
        ->addCssClass("grid-example");
$gridExample->printHtml();
