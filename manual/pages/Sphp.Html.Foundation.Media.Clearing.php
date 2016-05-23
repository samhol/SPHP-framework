<?php

namespace Sphp\Html\Foundation\Media;

use Sphp\Html\Apps\ApiTools\PHPExampleViewer as CodeExampleViewer;

$media = $api->getNamespaceLink(__NAMESPACE__);



$clearing = $api->getClassLink(Clearing::class);
$lightbox = $api->getClassLink(Lightbox::class);
$orbit = $api->getClassLink(Orbit::class);

echo $parsedown->text(<<<MD
###The $clearing container for $lightbox components

$clearing and $lightbox components makes it easy to create responsive lightboxes with any size image. 
It replaces the $orbit system.
MD
);

CodeExampleViewer::visualize(EXAMPLE_DIR . 'Sphp/Html/Foundation/Media/Clearing.php');
