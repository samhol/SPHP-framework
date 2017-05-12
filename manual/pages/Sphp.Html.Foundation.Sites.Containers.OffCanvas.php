<?php

namespace Sphp\Html\Foundation\Sites\Containers\OffCanvas;

use Sphp\Html\Apps\Syntaxhighlighting\CodeExampleBuilder;
use Sphp\Html\Apps\Manual\Apis;

$offCanvas = Apis::sami()->classLinker(OffCanvas::class);
echo $parsedown->text(<<<MD

##The $offCanvas component

The $offCanvas menu component is positioned outside of the viewport and gets slided in when activated.
MD
);
CodeExampleBuilder::visualize('Sphp/Html/Foundation/Sites/Containers/OffCanvas.php');
