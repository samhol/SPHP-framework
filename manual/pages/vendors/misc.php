<?php

use Sphp\Html\Flow\Section;
use Sphp\Html\Foundation\Sites\Media\Orbit\Orbit;

$orbitIntro = new Orbit();
$orbitIntro->addCssClass('sphp', 'manual', 'vendor-readme-orbit', $vendorName);

$phpunitSection = new Section();
$phpunitSection->appendMdFile('manual/pages/vendors/md/misc/phpunit.md');
$orbitIntro->slides()->append($phpunitSection)->addCssClass('php');

$scssSection = new Section();
$scssSection->appendMdFile('manual/pages/vendors/md/misc/scss.md');
$orbitIntro->slides()->append($scssSection)->addCssClass('scss');

$orbitIntro->printHtml();

