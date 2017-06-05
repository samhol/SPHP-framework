<?php

namespace Sphp\Html\Foundation\Sites; 

use Sphp\Html\Foundation\Sites\Media\Orbit\Orbit;
use Sphp\Html\Foundation\Sites\Media\Orbit\Slide;

$orbitIntro = new Orbit();
$orbitIntro->addCssClass('foundation-intro');
$gridSlide = new Slide();
$gridSlide->appendMdFile('manual/pages/Foundation-intro/Grids.php');
$orbitIntro->append($gridSlide);
$navSlide = new Slide();
$navSlide->appendMdFile('manual/pages/Foundation-intro/Navigation.php');
$orbitIntro->append($navSlide);
$buttonSlide = new Slide();
$buttonSlide->appendMdFile('manual/pages/Foundation-intro/Buttons.php');
$orbitIntro->append($buttonSlide);
$hlSlide = (new Media\Orbit\SyntaxHighlightingSlide())
        ->loadFromFile('manual/examples/Sphp/Html/Foundation/Sites/Media/ResponsiveEmbed.php');
$orbitIntro->append($hlSlide);
$orbitIntro->appendMdFile('manual/pages/Foundation-intro/Media.php');
$orbitIntro->appendMdFile('manual/pages/Foundation-intro/Forms.php');

$orbitIntro->printHtml();
