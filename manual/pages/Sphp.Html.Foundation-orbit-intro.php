<?php

namespace Sphp\Html\Foundation\F6;

use Sphp\Html\Foundation\F6\Media\Orbit\Orbit;
use Sphp\Html\Foundation\F6\Media\Orbit\Slide;
use Sphp\Core\PathFinder as PathFinder;

$pathFinder = new PathFinder();
$orbitIntro = new Orbit();
$orbitIntro->addCssClass("foundation-intro");
$gridSlide = new Slide();
$gridSlide->appendMdFile($pathFinder->local("manual/pages/Foundation-intro/Grids.php"));
$orbitIntro->append($gridSlide);
$navSlide = new Slide();
$navSlide->appendMdFile($pathFinder->local("manual/pages/Foundation-intro/Navigation.php"));
$orbitIntro->append($navSlide);
$buttonSlide = new Slide();
$buttonSlide->appendMdFile($pathFinder->local("manual/pages/Foundation-intro/Buttons.php"));
$orbitIntro->append($buttonSlide);
$mediaSlide = new Slide();
$mediaSlide->appendMdFile($pathFinder->local("manual/pages/Foundation-intro/Media.php"));
$orbitIntro->append($mediaSlide);
$formsSlide = new Slide();
$formsSlide->appendMdFile($pathFinder->local("manual/pages/Foundation-intro/Forms.php"));
$orbitIntro->append($formsSlide);
$orbitIntro->printHtml();
