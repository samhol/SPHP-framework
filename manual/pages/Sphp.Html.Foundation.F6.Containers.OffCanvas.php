<?php

namespace Sphp\Html\Foundation\Sites\Containers\OffCanvas;

$offCanvas = $api->classLinker(OffCanvas::class);
echo $parsedown->text(<<<MD

##The $offCanvas component

The $offCanvas menu component is positioned outside of the viewport and gets slided in when activated.
MD
);
$exampleViewer(EXAMPLE_DIR . 'Sphp/Html/Foundation/F6/Containers/OffCanvas.php');