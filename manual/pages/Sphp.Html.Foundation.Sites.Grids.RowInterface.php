<?php

namespace Sphp\Html\Foundation\Sites\Grids;

use Sphp\Html\Apps\Syntaxhighlighting\CodeExampleBuilder;
use Sphp\Html\Apps\Manual\Apis;

$gridIf = Apis::sami()->classLinker(GridInterface::class);
$htmlCont = Apis::sami()->classLinker(\Sphp\Html\Container::class);
$grid = Apis::sami()->classLinker(Grid::class);
$row = Apis::sami()->classLinker(Row::class);
$rowIf = Apis::sami()->classLinker(RowInterface::class);
$colIf = Apis::sami()->classLinker(ColumnInterface::class);
$col = Apis::sami()->classLinker(Column::class);
$cols = Apis::sami()->classLinker(ColumnInterface::class, "Columns");
$gridsLnk = Apis::sami()->namespaceLink(__NAMESPACE__);
$f_GridLink = Apis::foundation()->getComponentLink(Grid::class, "Foundation Grid layout");

$codeExampleBuilder = new CodeExampleBuilder('Sphp/Html/Foundation/Sites/Grids/Grid_fromArray.php', 'html5');


echo $parsedown->text(<<<MD
##The $rowIf <small>and its implementations</small>
		
A $rowIf defines a horizontal block containing vertical $colIf components. 
It forms a single row in a $gridIf layout, but it can be used as a individual component also.

####Creating a Row from an array of column contents
		


* A simple way to create a $row containing $cols with equal widths is to either construct 
a $row with column contents as its first parameter or set the columns similarly by calling {$rowIf->methodLink("setColumns")} method.
	* The number of the inserted columns can be `1,2,3,4,6` or `12` for equal width columns that expand the entire $row.
	* if the space used by the inserted columns is smaller than 12, the last $col will be floated to the right of the $row.
		
###An example of rows generated from arrays containing plain $col content.
MD
);
$codeExampleBuilder->setPath('Sphp/Html/Foundation/Sites/Grids/Row_fromArray.php')
        ->buildAccordion()
        ->addCssClass('grid-example')
        ->printHtml();

echo $parsedown->text(<<<MD
		
###An example of rows generated from arrays containing $col objects and plain content.
 		
MD
);

$codeExampleBuilder->setPath('Sphp/Html/Foundation/Sites/Grids/Row-mixed-constructor.php')
        ->buildAccordion()
        ->addCssClass('grid-example')
        ->printHtml();

echo $parsedown->text(<<<MD
		
####Incomplete $row components

In order to work around browsers' different rounding behaviors, Foundation will float the last $col in a $row to the right so the edge aligns.
If the $row doesn't have a count that adds up to 12 $cols, the last $col can be tagged with a class of end in order to override that behavior.

MD
);

