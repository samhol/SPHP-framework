<?php

namespace Sphp\Manual\Vendors;

use Sphp\Html\Lists\Ul;
use Sphp\Html\Media\Icons\FontAwesome;

require_once __DIR__ . '/jsonParsing.php';
$required = getNpmPackages();
$ul = new Ul();
$ul->addCssClass('no-bullet');
$fa = new FontAwesome();
$fa->fixedWidth(true);
$fa->setSize('lg');
foreach ($required as $component => $version) {
  $package = str_replace('zendframework/', '', $component);
  $ul->appendLink("https://www.npmjs.com/package/$component", "{$fa->createIcon('fab fa-npm')} $package");
}
?>
# JavaScript packages

Zend Framework is a collection of professional PHP packages. It can be used to 
develop web applications and services using PHP 5.6+, and provides 100% 
object-oriented code using a broad spectrum of language features.

## Included packages

<?php
echo $ul;
