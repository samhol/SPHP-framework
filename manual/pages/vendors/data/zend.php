<?php

namespace Sphp\Manual\Vendors;

use Sphp\Stdlib\Arrays;
use Sphp\Html\Lists\Ul;
use Sphp\Html\Media\Icons\FontAwesome;
use Sphp\Html\Tags;
require_once __DIR__ . '/jsonParsing.php';
$required = getComposerPackages();
$zends = Arrays::findKeysLike($required, 'zendframework');
$ul = new Ul();
$ul->addCssClass('packages');
$fa = new FontAwesome();
$fa->fixedWidth(true);
foreach ($zends as $component => $version) {
  $package = str_replace('zendframework/', '', $component);
  $ul->appendLink("https://github.com/$component", Tags::span($fa->createIcon('fab fa-github'))->addCssClass('icon'). Tags::span($package)->addCssClass('text'));
}
?>
# Zend Framework

Zend Framework is a collection of professional PHP packages. It can be used to 
develop web applications and services using PHP 5.6+, and provides 100% 
object-oriented code using a broad spectrum of language features.

## Used Zend packages

<?php
echo $ul;
