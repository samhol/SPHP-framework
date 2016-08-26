<?php

namespace Sphp\Html\Foundation\F6\Grids;

use Sphp\Html\Apps\Manual\FoundationDocsLinker as FoundationDocsLinker;

$grid = $api->classLinker(Grid::class);
$row = $api->classLinker(Row::class);
$col = $api->classLinker(Column::class);
$cols = $api->classLinker(Column::class, "Columns");
//$ns = $api->namespaceLink(__NAMESPACE__);
$ns = $api->namespaceBreadGrumbs(__NAMESPACE__);
$gridInterface = $api->classLinker(GridInterface::class);
$f_GridLink = FoundationDocsLinker::get()->gridLink(null, "Foundation Grid layout");
echo $parsedown->text(<<<MD
#Foundation 6 Grids and Block Grids    
$ns	
This namespace contains $f_GridLink related interfaces and implementations.
MD
);
$load("Sphp.Html.Foundation.F6.Grids.GridInterface.php");

$blockGrid = $api->classLinker(BlockGrid::class);
echo $parsedown->text(<<<MD
##The $blockGrid component
	

A $blockGrid component splits evenly its contents within the grid.

**Important!**

A $blockGrid component is `mobile-first`. Code for small screens first, and larger 
devices will inherit those styles. Customize for larger screens as necessary.

If you use the small block grid only, the grid will keep its spacing and 
configuration no matter the screen size. If you use large block grid only, the 
list items will stack on top of each other for small devices. If you use both of 
those classes combined, you can control the configuration and layout separately 
for each breakpoint.
        
MD
);
$exampleViewer(EXAMPLE_DIR . 'Sphp/Html/Foundation/F6/Grids/BlockGrid.php');
