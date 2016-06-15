<?php

namespace Sphp\Html\Foundation\F6\Media\Orbit;

use Sphp\Html\Foundation\F6\Containers\Accordions\SyntaxHighlightingSingleAccordion as SyntaxHighlightingSingleAccordion;

$media = $api->getNamespaceLink(__NAMESPACE__);
$ns = $api->getNamespaceBreadGrumbs(__NAMESPACE__);

$orbit = $api->classLinker(Orbit::class);
$slide = $api->classLinker(Slide::class);

echo $parsedown->text(<<<MD
##The $orbit container and the $slide components
$ns
$orbit is a responsive container for image on other content sliders that allows swiping on touch-enabled devices.
An $orbit containing $slide components can not handle variable-height content.
MD
);
echo '<div class="wrapper">';
include EXAMPLE_DIR . 'Sphp/Html/Foundation/F6/Media/OrbitSlide.php';

echo "</div>";
SyntaxHighlightingSingleAccordion::visualize(EXAMPLE_DIR . 'Sphp/Html/Foundation/F6/Media/OrbitSlide.php');