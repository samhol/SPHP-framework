<?php

namespace Sphp\Html\Foundation\Sites\Grids;

use Sphp\Html\Apps\Syntaxhighlighting\CodeExampleBuilder;
use Sphp\Html\Apps\Manual\Apis;

$blockGrid = Apis::sami()->classLinker(BlockGrid::class);
echo $parsedown->text(<<<MD
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
CodeExampleBuilder::visualize('Sphp/Html/Foundation/Sites/Grids/BlockGrid.php');
