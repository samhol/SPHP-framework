<?php

namespace Sphp\Html\Foundation\Sites\Media\Orbit;

$orbitIntro = new Orbit();
$orbitIntro->setAnimIn('fade-in')
        ->setAnimOut('fade-out')
        ->pauseOnHover(true);
$orbitIntro->addCssClass('intro');
$orbitIntro->slides()->appendMdFile('manual/pages/Sphp-intro/introduction.php');
$orbitIntro->slides()->appendMdFile('manual/pages/Sphp-intro/libraries.php');
$orbitIntro->slides()->appendMdFile('manual/pages/Foundation-intro/Grids.php');
$orbitIntro->slides()->appendMdFile('manual/pages/Foundation-intro/Media.php');
$orbitIntro->slides()->appendMdFile('manual/pages/Foundation-intro/Forms.php');
$orbitIntro->setActive(0);
$orbitIntro->printHtml();
