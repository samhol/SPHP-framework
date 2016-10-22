<?php

namespace Sphp\Html\Foundation\Sites;

use Sphp\Html\Foundation\Sites\Media\Orbit\Orbit;
use Sphp\Core\Router;

$orbitIntro = new Orbit();
$orbitIntro->addCssClass("intro");
$orbitIntro->appendMdFile(Router::get()->local("manual/pages/Core-intro/intro.php"));
$orbitIntro->appendMdFile(Router::get()->local("manual/pages/Core-intro/ErrorHandling.php"));
$orbitIntro->printHtml();
