<?php

namespace Sphp\Core;

use Sphp\Html\Foundation\F6\Media\Orbit\Orbit as Orbit;
use Sphp\Html\Foundation\F6\Media\Orbit\Slide as Slide;
use Sphp\Core\PathFinder as PathFinder;

$pathFinder = new PathFinder();
$orbitIntro = new Orbit();
$orbitIntro->addCssClass("foundation-intro");
$orbitIntro->appendMdFile($pathFinder->local("manual/pages/Sphp-intro/introduction.php"));
$orbitIntro->appendMdFile($pathFinder->local("manual/pages/Sphp-intro/libraries.php"));

$orbitIntro->printHtml();
