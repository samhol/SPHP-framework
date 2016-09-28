<?php

namespace Sphp\Html\Foundation\F6;

use Sphp\Html\Foundation\F6\Media\Orbit\Orbit;
use Sphp\Core\PathFinder;

$pathFinder = new PathFinder();
$orbitIntro = new Orbit();
$orbitIntro->addCssClass("intro");
$orbitIntro->appendMdFile($pathFinder->local("manual/pages/Core-intro/intro.php"));
$orbitIntro->appendMdFile($pathFinder->local("manual/pages/Core-intro/ErrorHandling.php"));
$orbitIntro->printHtml();
