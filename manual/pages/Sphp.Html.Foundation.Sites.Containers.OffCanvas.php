<?php

namespace Sphp\Html\Foundation\Sites\Containers\OffCanvas;

use Sphp\Html\Apps\Syntaxhighlighting\CodeExampleBuilder;
use Sphp\Html\Apps\Manual\Apis;

$offCanvas = \Sphp\Manual\api()->classLinker(OffCanvas::class);
\Sphp\Manual\parseDown(<<<MD

##The $offCanvas component

The $offCanvas menu component is positioned outside of the viewport and gets slided in when activated.
MD
);
CodeExampleBuilder::visualize('Sphp/Html/Foundation/Sites/Containers/OffCanvas.php');
