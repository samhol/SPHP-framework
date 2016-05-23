<?php

namespace Sphp\Html\Foundation\Media;

use Sphp\Html\Apps\ApiTools\PHPExampleViewer as CodeExampleViewer;

$media = $api->getNamespaceLink(__NAMESPACE__);

$orbit = $api->classLinker(Orbit::class);
$slide = $api->classLinker(Slide::class);

echo $parsedown->text(<<<MD
###The $orbit container and the $slide components

$orbit is a responsive container for image on other content sliders that allows swiping on touch-enabled devices.
An $orbit containing $slide components can not handle variable-height content.
Orbit has been deprecated from the Foundation framework, meaning that it is no longer supported.
MD
);
CodeExampleViewer::visualize(EXAMPLE_DIR . 'Sphp/Html/Foundation/Media/OrbitSlide.php');
