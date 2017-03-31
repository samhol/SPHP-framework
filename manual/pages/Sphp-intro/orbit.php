<?php

namespace Sphp\Html\Foundation\Sites\Media\Orbit;

$orbitIntro = new Orbit();
$orbitIntro->setAnimIn('fade-in')
        ->setAnimOut('fade-out')
        ->pauseOnHover(true);
$orbitIntro->addCssClass('intro');
$orbitIntro->appendMdFile('manual/pages/Sphp-intro/introduction.php');
$orbitIntro->appendMdFile('manual/pages/Sphp-intro/libraries.php');
$orbitIntro->appendMdFile('manual/pages/Foundation-intro/Grids.php');
$orbitIntro->appendMdFile('manual/pages/Foundation-intro/Media.php');
$orbitIntro->appendMdFile('manual/pages/Foundation-intro/Forms.php');
$orbitIntro->printHtml();
