<?php

namespace Sphp\Html\Foundation\F6\Core;

$grid = $api->classLinker(Grid::class);
$row = $api->classLinker(Row::class);
$col = $api->classLinker(Column::class);
$cols = $api->getClassLink(Column::class, "Columns");
//$ns = $api->getNamespaceLink(__NAMESPACE__);
$ns = $api->getNamespaceBreadGrumbs(__NAMESPACE__);
$f_GridLink = $foundation->getComponentLink(Grid::class, "Foundation Grid layout");
echo $parsedown->text(<<<MD
#THE FOUNDATION CORE
        
$ns	
        
This namespace contains interfaces, traits and components for Foundation based layout design and layout management.
MD
);
$load("Sphp.Html.Foundation.F6.Core.GridInterface.php");
$blockGridApiLink = $api->getClassLink(BlockGrid::class);
echo $parsedown->text(<<<MD
##The $blockGridApiLink component
		
A $blockGridApiLink component splits evenly its contents within the grid. For example 
<a href="#" >a row of five link list</a> on the footer section of this document is implemented using 
this component.
MD
);
$exampleViewer(EXAMPLE_DIR . 'Sphp/Html/Foundation/F6/Core/BlockGrid.php');

//$load("Sphp.Html.Foundation.F6.Core.VisibilityHandler.php");
