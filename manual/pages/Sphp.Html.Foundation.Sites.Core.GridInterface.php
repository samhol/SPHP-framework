<?php

namespace Sphp\Html\Foundation\Sites\Core;

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
#Foundation Grids and BlockGrids in SPHP Framework

$f_GridLink is a `12-column` flexible grid that can scale out to an arbitrary 
size (defined by the max-width of the row) that's also easily nested, so it is possible 
build out complicated layouts without creating a lot of custom elements.
		
The Grid is **mobile-first** layout. So as a rule of thumb coding starts from small screens first, 
and larger devices will inherit those styles. Distinct features for larger screens can always be 
included when necessary.

$gridsLnk namespace contains $f_GridLink related interfaces and a working implementation of them.

##The horizontal $rowIf interface implementations
		
A $rowIf type defines a horizontal block containing vertical $colIf components. 
It forms a row in the Grid layout. SPHP Framework has alse default implementations 
for rows and columns namely $row and $col.
		
Column settings like widths, offsets, centering etc... can be set for different 
screen sizes separatedly if nessesary. However larger screens will inherit these 
settings from smaller ones.

####Creating a $row component containing $cols with equal widths
		
A simple way to create a $row containing $cols with equal widths is to either construct 
a $row with column contents as a parameter or set the columns similarly by calling {$rowIf->methodLink("setColumns")} method.
The calculates the widths of the individual $cols by dividing the maximum $row width with the number of the given $cols.
1. The number of the $cols in a $row can be any number between 1-12.
2. A simple way to create a $row containing $cols with equal widths is to simply construct a $row with column contents as a parameter.
	* The number of the input $cols can be `1,2,3,4,6` or `12` for equal width columns that expand the entire $row.
	* if the number of the input $cols is not divisible by 12, the last $col will be floated to the right of the $row.
		
###An example of rows generated from arrays containing plain $col content.
MD
);
$rowExample1 =  new CodeExampleAccordion(EXAMPLE_DIR . 'Sphp/Html/Foundation/F6/Core/Row-array-constructor.php', false);
$rowExample1
        ->getOutputPane()
        ->addCssClass("grid-example");
$rowExample1->printHtml();
echo $parsedown->text(<<<MD
		
###An example of rows generated from arrays containing $col objects and plain content.
 		
MD
);       

$rowExample2 =  new CodeExampleAccordion(EXAMPLE_DIR . 'Sphp/Html/Foundation/F6/Core/Row-mixed-constructor.php');
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
		
The $gridIf is an implementation of Foundation 6 Grid. Any
$gridIf implementation like the default $grid is a container for $rowIf type
components. A $grid component itself without any $rowIf content does not output 
any HTML into the document.
		
MD
);
/*$rowExample =  new CodeExampleAccordion(EXAMPLE_DIR . 'Sphp/Html/Foundation/F6/Core/Grid-ArrayAccess.php');
$rowExample
        ->getOutputPane()
        ->addCssClass("grid-example");
$rowExample->printHtml();*/
//PHPExampleViewer::visualize(EXAMPLE_DIR . 'Sphp/Html/Foundation/Grids/Grid1.php');
//PHPExampleViewer::visualize(EXAMPLE_DIR . 'Sphp/Html/Foundation/Grids/GridInterface.php');
$gridExample = new CodeExampleAccordion();
$gridExample->fromFile(EXAMPLE_DIR . 'Sphp/Html/Foundation/F6/Core/GridInterface.php');
$gridExample
        ->getOutputPane()
        ->addCssClass("grid-example");
$gridExample->printHtml();
