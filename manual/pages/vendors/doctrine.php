<?php

use Sphp\Html\Flow\Section;
use Sphp\Html\Foundation\Sites\Media\Orbit\Orbit;

$doctrineIntro = new Orbit();
$doctrineIntro->addCssClass('sphp', 'manual', 'vendor-readme-orbit');
$doctrineIntro->autoplay(false);
$doctrineIntro->attributes()->setAttribute('data-options', 'animInFromLeft:fade-in; animInFromRight:fade-in; animOutToLeft:fade-out; animOutToRight:fade-out;');
$path = realpath('manual/pages/vendors/md/doctrine/');

$objects = new RecursiveIteratorIterator(new RecursiveDirectoryIterator($path));
foreach ($objects as $name => $object) {
  if ($object->isFile()) {
    $section = new Section();
    $section->appendMdFile($object->getRealPath());
    $doctrineIntro->slides()->append($section)->addCssClass('doctrine');
  }
}
//$section = new Section();
//$section->appendMdFile('manual/pages/Sphp-intro/libraries.php');
//$doctrineIntro->slides()->append($section);
$doctrineIntro->printHtml();
