<?php

namespace Sphp\Html\Foundation\Structure;

use Sphp\Html\Apps\SyntaxHighlightingAccordion as SyntaxHighlighter;
use Sphp\Html\Apps\ApiTools\PHPExampleViewer as CodeExampleViewer;

$grid = $api->getClassLink(Grid::class);
$row = $api->getClassLink(Row::class);
$col = $api->getClassLink(Column::class);
$cols = $api->getClassLink(Column::class, "Columns");
$ns = $api->getNamespaceLink(__NAMESPACE__);
$f_GridLink = $foundation->getComponentLink(Grid::class, "Foundation Grid layout");
echo $parsedown->text(<<<MD
#THE $ns NAMESPACE
		
This namespace contains interfaces, traits and components for Foundation based layout design and layout management.
MD
);
$load("Sphp.Html.Foundation.Structure.GridInterface.php");
$blockGridApiLink = $api->getClassLink(BlockGrid::class);
echo $parsedown->text(<<<MD
##The $blockGridApiLink component
		
A $blockGridApiLink component splits evenly its contents within the grid.For example 
a row of five link list on the footer section of this document is implemented using 
the $blockGridApiLink component.
MD
);
CodeExampleViewer::visualize(EXAMPLE_DIR . 'Sphp/Html/Foundation/Structure/blockGrid.php');

(new SyntaxHighlighter())
		->loadFromFile(EXAMPLE_DIR . 'footerLinks.php')
		->setHeading("PHP code of the footer link lists")
		->printHtml();
echo $parsedown->text(<<<MD
**Note:** The footer links are using also {$api->getClassLink(\Sphp\Html\Lists\Ul::class)}.
MD
);
$load("Sphp.Html.Foundation.Structure.VisibilityHandler.php");
