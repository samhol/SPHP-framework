<?php

use Sphp\Html\Flow\Section;
use Sphp\Html\Foundation\Sites\Media\Orbit\Orbit;

$orbitIntro = new Orbit();
$orbitIntro->addCssClass('sphp', 'manual', 'vendor-readme-orbit');


$path = realpath('manual/pages/vendors/md/zend/');

$objects = new RecursiveIteratorIterator(new RecursiveDirectoryIterator($path));
foreach ($objects as $name => $object) {
  if ($object->isFile()) {
    $cacheSection = new Section();
    $cacheSection->appendMdFile($object->getRealPath());
    $orbitIntro->slides()->append($cacheSection)->addCssClass('zend');
  }
}

$orbitIntro->printHtml();

