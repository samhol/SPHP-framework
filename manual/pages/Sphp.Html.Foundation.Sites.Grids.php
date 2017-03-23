<?php

namespace Sphp\Html\Foundation\Sites\Grids;

use Sphp\Html\Foundation\Sites\Containers\Accordions\CodeExampleAccordion;
use Sphp\Html\Apps\Manual\Apis;

$grid = Apis::apigen()->classLinker(Grid::class);
$row = Apis::apigen()->classLinker(Row::class);
$col = Apis::apigen()->classLinker(Column::class);
$cols = Apis::apigen()->classLinker(Column::class, "Columns");

$ns = Apis::apigen()->namespaceBreadGrumbs(__NAMESPACE__);
$gridInterface = Apis::apigen()->classLinker(GridInterface::class);
$f_GridLink = Apis::foundation()->gridLink(null, "Foundation Grid layout");
echo $parsedown->text(<<<MD
#Foundation 6 Grids and Block Grids    
$ns	
This namespace contains $f_GridLink related interfaces and implementations.
MD
);
$load("Sphp.Html.Foundation.Sites.Grids.GridInterface.php");

$blockGrid = Apis::apigen()->classLinker(BlockGrid::class);
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
CodeExampleAccordion::visualize(EXAMPLE_DIR . 'Sphp/Html/Foundation/F6/Grids/BlockGrid.php');
