<?php

namespace Sphp\Core;

use Sphp\Html\Foundation\Sites\Media\Orbit\Orbit;
use Sphp\Core\Router;

$path = Router::get();
$orbitIntro = new Orbit();
$orbitIntro->setAnimIn("fade-in")->setAnimOut("fade-out")->pauseOnHover();
$orbitIntro->addCssClass("intro");
$orbitIntro->appendMdFile($path->local("manual/pages/Sphp-intro/introduction.php"));
$orbitIntro->appendMdFile($path->local("manual/pages/Sphp-intro/libraries.php"));
$orbitIntro->appendMdFile($path->local("manual/pages/Core-intro/ErrorHandling.php"));
$orbitIntro->appendMdFile($path->local("manual/pages/Foundation-intro/Grids.php"));
$orbitIntro->appendMdFile($path->local("manual/pages/Foundation-intro/Media.php"));
$orbitIntro->appendMdFile($path->local("manual/pages/Foundation-intro/Forms.php"));

$orbitIntro->printHtml();
