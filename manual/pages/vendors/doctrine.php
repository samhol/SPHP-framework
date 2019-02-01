<?php

use Sphp\Html\Flow\Section;
use Sphp\Html\Foundation\Sites\Media\Orbit\Orbit;

$orbitIntro = new Orbit();
$orbitIntro->addCssClass('sphp', 'manual', 'vendor-readme-section', $vendorName);

$common = new Section();
$common->appendMdFile('vendor/doctrine/common/README.md');
$orbitIntro->slides()->append($common);

$cache = new Section();
$cache->appendMdFile('vendor/doctrine/cache/README.md');
$orbitIntro->slides()->append($cache);

$orm = new Section();
$orm->appendMdFile('vendor/doctrine/orm/README.md');
$orbitIntro->slides()->append($orm);

$dbal = new Section();
$dbal->appendMdFile('vendor/doctrine/dbal/README.md');
$orbitIntro->slides()->append($dbal);

$reflection = new Section();
$reflection->appendMdFile('vendor/doctrine/reflection/README.md');
$orbitIntro->slides()->append($reflection);
$orbitIntro->printHtml();


$path = realpath('manual/pages/vendors/md/zend/');

$objects = new RecursiveIteratorIterator(new RecursiveDirectoryIterator($path));
foreach ($objects as $name => $object) {
  if ($object->isFile()) {
    echo "$name\n";
  }
}