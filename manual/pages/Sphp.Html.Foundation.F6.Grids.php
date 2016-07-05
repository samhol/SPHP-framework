<?php

namespace Sphp\Html\Foundation\F6\Grids;

use Sphp\Html\Apps\ApiTools\FoundationDocsLinker as FoundationDocsLinker;

$grid = $api->classLinker(Grid::class);
$row = $api->classLinker(Row::class);
$col = $api->classLinker(Column::class);
$cols = $api->getClassLink(Column::class, "Columns");
//$ns = $api->getNamespaceLink(__NAMESPACE__);
$ns = $api->getNamespaceBreadGrumbs(__NAMESPACE__);
$gridInterface = $api->classLinker(GridInterface::class);
$f_GridLink = FoundationDocsLinker::get()->gridLink(null, "Foundation Grid layout");
echo $parsedown->text(<<<MD
#Foundation 6 Grids and Block Grids    
$ns	
This namespace contains $f_GridLink related interfaces and implementations.
MD
);
$load("Sphp.Html.Foundation.F6.Grids.GridInterface.php");

$blockGrid = $api->getClassLink(BlockGrid::class);
echo $parsedown->text(<<<MD
##The $blockGrid component
		
A $blockGrid component splits evenly its contents within the grid. This component 
is mobile-first. Code for small screens first, and larger devices will inherit 
those styles. Customize for larger screens as necessary.        
MD
);
$exampleViewer(EXAMPLE_DIR . 'Sphp/Html/Foundation/F6/Grids/BlockGrid.php');
