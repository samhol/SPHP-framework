<?php

use Sphp\Html\Flow\Section;
use Sphp\Html\Foundation\Sites\Media\Orbit\Orbit;

$orbitIntro = new Orbit();
$orbitIntro->addCssClass('sphp', 'manual', 'vendor-readme-orbit');
$orbitIntro->setAnimIn('fade-in');
$orbitIntro->setAnimOut('fade-out');

$sphpSection = new Section();
$sphpSection->appendMdFile('./manual/pages/vendors/data/sphp.php');
$orbitIntro->slides()->append($sphpSection)->addCssClass('sphp');

$packageSection = new Section();
$packageSection->appendMdFile('./manual/pages/vendors/data/foo.php');
$orbitIntro->slides()->append($packageSection)->addCssClass('zend');

$zendSection = new Section();
$zendSection->appendMdFile('./manual/pages/vendors/data/zend.php');
$orbitIntro->slides()->append($zendSection)->addCssClass('zend');

$phpunitSection = new Section();
$phpunitSection->appendMdFile('./manual/pages/vendors/data/php-testing.php');
$orbitIntro->slides()->append($phpunitSection)->addCssClass('php');

$jsSection = new Section();
$jsSection->appendMdFile('./manual/pages/vendors/data/misc/scss.md');
$orbitIntro->slides()->append($jsSection)->addCssClass('scss');

$scssSection = new Section();
$scssSection->appendMdFile('./manual/pages/vendors/data/js.php');
$orbitIntro->slides()->append($scssSection)->addCssClass('js');

$orbitIntro->printHtml();
