<?php

namespace Sphp\Manual\Vendors;

use Sphp\Html\Lists\Ul;
use Sphp\Html\Media\Icons\FontAwesome;
use Sphp\Html\Tags;

require_once __DIR__ . '/jsonParsing.php';
$required = getNpmPackages();
$ul = new Ul();
$ul->addCssClass('packages');
$fa = new FontAwesome();
$fa->fixedWidth(true);
//$fa->setSize('lg');
foreach ($required as $component => $version) {
  $package = str_replace('zendframework/', '', $component);
  $ul->appendLink("https://www.npmjs.com/package/$component",
          Tags::span($fa->createIcon('fab fa-npm'))->addCssClass('icon') .
          Tags::span($package)->addCssClass('text'));
}
?>
# Client side JavaScript


## Included packages

<?php
echo $ul;
