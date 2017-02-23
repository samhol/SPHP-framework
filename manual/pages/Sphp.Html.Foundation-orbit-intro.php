<?php

namespace Sphp\Html\Foundation\Sites;

use Sphp\Html\Foundation\Sites\Media\Orbit\Orbit;
use Sphp\Html\Foundation\Sites\Media\Orbit\Slide;
use Sphp\Stdlib\Path;

$path = Path::get();
$orbitIntro = new Orbit();
$orbitIntro->addCssClass("foundation-intro");
$gridSlide = new Slide();
$gridSlide->appendMdFile($path->local("manual/pages/Foundation-intro/Grids.php"));
$orbitIntro->append($gridSlide);
$navSlide = new Slide();
$navSlide->appendMdFile($path->local("manual/pages/Foundation-intro/Navigation.php"));
$orbitIntro->append($navSlide);
$buttonSlide = new Slide();
$buttonSlide->appendMdFile($path->local("manual/pages/Foundation-intro/Buttons.php"));
$orbitIntro->append($buttonSlide);
$hlSlide = (new Media\Orbit\SyntaxHighlightingSlide())->loadFromFile(Path::get()->local('manual/examples/Sphp/Html/Foundation/F6/Media/Flex-LazyLoad.php'));
$orbitIntro->append($hlSlide);
$orbitIntro->appendMdFile($path->local("manual/pages/Foundation-intro/Media.php"));
$orbitIntro->appendMdFile($path->local("manual/pages/Foundation-intro/Forms.php"));

$orbitIntro->printHtml();
