<?php

namespace Sphp\Html\Foundation\Sites\Grids;

use Sphp\Manual;

$blockGrid = Manual\api()->classLinker(BlockGrid::class);
Manual\md(<<<MD
##$blockGrid <small>for equally-sized columns</small>
	
Block grids are a shorthand way to create equally-sized columns.

**Important!**

If you use the small block grid only, the grid will keep its spacing and 
configuration no matter the screen size. If you use large block grid only, the 
list items will stack on top of each other for small devices. If you use both of 
those classes combined, you can control the configuration and layout separately 
for each breakpoint.
        
MD
);
Manual\example('Sphp/Html/Foundation/Sites/Grids/XY/BlockGrid.php')->printHtml();
