<?php

namespace Sphp\Html\Foundation\Sites\Media\Orbit;

use Sphp\Html\Foundation\Sites\Containers\Accordions\SyntaxHighlightingSingleAccordion;
use Sphp\Manual;

$ns = Manual\api()->namespaceBreadGrumbs(__NAMESPACE__);
$orbit = Manual\api()->classLinker(Orbit::class);
$slide = Manual\api()->classLinker(HtmlSlide::class);

Manual\md(<<<MD
##$orbit <small>An image and content carousel</small>
$ns
 Orbit is a Foundation based image and content carousel with animation support 
and many customizable options. Orbit allows swiping on touch-enabled devices.
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

