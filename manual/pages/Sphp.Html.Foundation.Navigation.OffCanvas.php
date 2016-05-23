<?php

namespace Sphp\Html\Foundation\Navigation\OffCanvas;

$offCanvas = $api->getClassLink(OffCanvas::class);
echo $parsedown->text(<<<MD

##The $offCanvas component

The $offCanvas menu component is positioned outside of the viewport and gets slided in when activated.
MD
);
$exampleViewer(EXAMPLE_DIR . 'Sphp/Html/Foundation/Navigation/OffCanvas.php', 2);