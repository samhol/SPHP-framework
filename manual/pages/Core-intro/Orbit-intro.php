<?php

namespace Sphp\Html\Foundation\Sites;

use Sphp\Html\Foundation\Sites\Media\Orbit\Orbit;

$orbitIntro = new Orbit();
$orbitIntro->addCssClass("intro");
$orbitIntro->appendMdFile("manual/pages/Core-intro/intro.php");
$orbitIntro->appendMdFile("manual/pages/Core-intro/ErrorHandling.php");
$orbitIntro->printHtml();
