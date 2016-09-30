<?php

namespace Sphp\Core;

use Sphp\Html\Foundation\F6\Media\Orbit\Orbit;
use Sphp\Core\Router;

$path = Router::get();
$orbitIntro = new Orbit();
$orbitIntro->setAnimIn("fade-in")->setAnimOut("fade-out");
$orbitIntro->addCssClass("intro");
$orbitIntro->appendMdFile($path->local("manual/pages/Sphp-intro/introduction.php"));
$orbitIntro->appendMdFile($path->local("manual/pages/Sphp-intro/libraries.php"));
$orbitIntro->appendMdFile($path->local("manual/pages/Core-intro/ErrorHandling.php"));

$orbitIntro->printHtml();
