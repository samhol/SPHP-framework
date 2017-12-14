<?php

namespace Sphp\Html\Foundation\Sites; 

use Sphp\Html\Foundation\Sites\Media\Orbit\Orbit;
use Sphp\Html\Foundation\Sites\Media\Orbit\HtmlSlide;

$orbitIntro = new Orbit();
$orbitIntro->addCssClass('foundation-intro');
$gridSlide = new HtmlSlide();
$gridSlide->appendMdFile('manual/pages/Foundation-intro/Grids.php');
$orbitIntro->append($gridSlide);
$navSlide = new HtmlSlide();
$navSlide->appendMdFile('manual/pages/Foundation-intro/Navigation.php');
$orbitIntro->append($navSlide);
$buttonSlide = new HtmlSlide();
$buttonSlide->appendMdFile('manual/pages/Foundation-intro/Buttons.php');
$orbitIntro->append($buttonSlide);
$orbitIntro->appendMdFile('manual/pages/Foundation-intro/Media.php');
$orbitIntro->appendMdFile('manual/pages/Foundation-intro/Forms.php');

$orbitIntro->printHtml();
