<?php

namespace Sphp\Html\Foundation\Sites\Containers\OffCanvas;

use Sphp\Html\Foundation\Sites\Containers\Accordions\CodeExampleAccordion;
use Sphp\Html\Apps\Manual\Apis;

$offCanvas = Apis::apigen()->classLinker(OffCanvas::class);
echo $parsedown->text(<<<MD

##The $offCanvas component

The $offCanvas menu component is positioned outside of the viewport and gets slided in when activated.
MD
);
CodeExampleAccordion::visualize(EXAMPLE_DIR . 'Sphp/Html/Foundation/F6/Containers/OffCanvas.php');
