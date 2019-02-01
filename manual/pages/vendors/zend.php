<?php

use Sphp\Html\Flow\Section;
use Sphp\Html\Foundation\Sites\Media\Orbit\Orbit;

$orbitIntro = new Orbit();
$orbitIntro->addCssClass('sphp', 'manual', 'vendor-readme-section', $vendorName);


$path = realpath('manual/pages/vendors/md/zend/');

$objects = new RecursiveIteratorIterator(new RecursiveDirectoryIterator($path));
foreach ($objects as $name => $object) {
  if ($object->isFile()) {

    $cacheSection = new Section();
    $cacheSection->appendMdFile($object->getRealPath());
    $orbitIntro->slides()->append($cacheSection);
  }
}
/*
$cacheSection = new Section();
$cacheSection->appendMdFile('manual/pages/vendors/md/zend/zend-cache/README.md');
$orbitIntro->slides()->append($cacheSection);
$section = new Section();
$section->appendMdFile('manual/pages/vendors/md/zend/zend-validator/README.md');
$orbitIntro->slides()->append($section);
$section1 = new Section();
$section1->appendMdFile('manual/pages/vendors/md/zend/zend-stdlib/README.md');
$orbitIntro->slides()->append($section1);
$section2 = new Section();
$section2->appendMdFile('manual/pages/vendors/md/zend/zend-i18n/README.md');
$orbitIntro->slides()->append($section2);
$section3 = new Section();
$section3->appendMdFile('manual/pages/vendors/md/zend/zend-mail/README.md');
$orbitIntro->slides()->append($section3);
*/
  $orbitIntro->printHtml();
 
