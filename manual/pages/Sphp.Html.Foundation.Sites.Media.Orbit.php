<?php

namespace Sphp\Html\Foundation\Sites\Media\Orbit;

use Sphp\Html\Foundation\Sites\Containers\Accordions\SyntaxHighlightingSingleAccordion;
use Sphp\Html\Apps\Manual\Apis;

$ns = \Sphp\Manual\api()->namespaceBreadGrumbs(__NAMESPACE__);

$orbit = \Sphp\Manual\api()->classLinker(Orbit::class);
$slide = \Sphp\Manual\api()->classLinker(Slide::class);

\Sphp\Manual\parseDown(<<<MD
##The $orbit container and the $slide components
$ns
$orbit is a responsive container for image on other content sliders that allows swiping on touch-enabled devices.
An $orbit containing $slide components can not handle variable-height content.
MD
);
echo '<div class="wrapper">';
include 'Sphp/Html/Foundation/Sites/Media/OrbitSlide.php';
echo "</div>";
SyntaxHighlightingSingleAccordion::visualize('Sphp/Html/Foundation/Sites/Media/OrbitSlide.php');

echo '<div class="wrapper" style="width: ">';
include 'Sphp/Html/Foundation/Sites/Media/Orbit-Video.php';
echo "</div>";
SyntaxHighlightingSingleAccordion::visualize('Sphp/Html/Foundation/Sites/Media/Orbit-Video.php');
