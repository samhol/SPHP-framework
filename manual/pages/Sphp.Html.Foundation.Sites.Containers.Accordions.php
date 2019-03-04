<?php

namespace Sphp\Html\Foundation\Sites\Containers\Accordions;

use Sphp\Manual;

$paneInterface = Manual\api()->classLinker(Pane::class);
$accordion = Manual\api()->classLinker(Accordion::class);
$ns = Manual\api()->namespaceBreadGrumbs(__NAMESPACE__);

Manual\md(<<<MD
        
### The $accordion container for $paneInterface components
$ns
> The graphical control element **accordion** is a vertically stacked list of items, 
> such as labels or thumbnails. Each item can be "expanded" or "stretched" to reveal 
> the content associated with that item. There can be zero expanded items, exactly 
> one, or more than one item expanded at a time, depending on the configuration.
> <cite class="wikipedia">[from Wikipedia](https://en.wikipedia.org/wiki/Accordion_(GUI))</cite>

MD
);

Manual\visualize('Sphp/Html/Foundation/Sites/Containers/Accordions/Accordions.php');
