<?php

namespace Sphp\Html\Foundation\Sites\Media\Orbit;

use Sphp\Html\Foundation\Sites\Containers\Accordions\SyntaxHighlightingSingleAccordion;
use Sphp\Html\Apps\Manual\Apis;

$ns = Apis::apigen()->namespaceBreadGrumbs(__NAMESPACE__);

$orbit = Apis::apigen()->classLinker(Orbit::class);
$slide = Apis::apigen()->classLinker(Slide::class);

echo $parsedown->text(<<<MD
##The $orbit container and the $slide components
$ns
$orbit is a responsive container for image on other content sliders that allows swiping on touch-enabled devices.
An $orbit containing $slide components can not handle variable-height content.
MD
);
echo '<div class="wrapper">';
include 'Sphp/Html/Foundation/F6/Media/OrbitSlide.php';
echo "</div>";
SyntaxHighlightingSingleAccordion::visualize('Sphp/Html/Foundation/F6/Media/OrbitSlide.php');

echo '<div class="wrapper" style="width: ">';
include 'Sphp/Html/Foundation/F6/Media/Orbit-Video.php';
echo "</div>";
SyntaxHighlightingSingleAccordion::visualize('Sphp/Html/Foundation/F6/Media/Orbit-Video.php');
