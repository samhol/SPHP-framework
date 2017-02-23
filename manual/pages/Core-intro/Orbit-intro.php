<?php

namespace Sphp\Html\Foundation\Sites;

use Sphp\Html\Foundation\Sites\Media\Orbit\Orbit;
use Sphp\Stdlib\Path;

$orbitIntro = new Orbit();
$orbitIntro->addCssClass("intro");
$orbitIntro->appendMdFile(Path::get()->local("manual/pages/Core-intro/intro.php"));
$orbitIntro->appendMdFile(Path::get()->local("manual/pages/Core-intro/ErrorHandling.php"));
$orbitIntro->printHtml();
