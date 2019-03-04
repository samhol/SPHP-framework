<?php

namespace Sphp\Html\Foundation\Sites\Containers\OffCanvas;

use Sphp\Manual;

$ns = Manual\api()->namespaceBreadGrumbs(__NAMESPACE__);

$offCanvas = \Sphp\Manual\api()->classLinker(OffCanvas::class);
\Sphp\Manual\md(<<<MD

### The $offCanvas component

$ns
        
The $offCanvas menu component is positioned outside of the viewport and gets slided in when activated.
MD
);
Manual\visualize('Sphp/Html/Foundation/Sites/Containers/OffCanvas.php');
