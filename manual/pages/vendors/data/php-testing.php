<?php

namespace Sphp\Manual\Vendors;

use Sphp\Stdlib\Arrays;
use Sphp\Html\Lists\Ul;
use Sphp\Html\Media\Icons\FontAwesome;

require_once __DIR__ . '/jsonParsing.php';
$required = getComposerPackages('require-dev');
$ul = new Ul();
$ul->addCssClass('no-bullet');
$fa = new FontAwesome();
$fa->fixedWidth(true);
foreach ($required as $component => $version) {
  $package = str_replace('zendframework/', '', $component);
  $ul->appendLink("https://github.com/$component", "{$fa->createIcon('fab fa-github')} $package");
}
?>
# PHPUnit

[![Latest Stable Version](https://img.shields.io/packagist/v/phpunit/phpunit.svg?style=flat-square)](https://packagist.org/packages/phpunit/phpunit)
[![Build Status](https://img.shields.io/travis/sebastianbergmann/phpunit/7.5.svg?style=flat-square)](https://phpunit.de/build-status.html)
[![Minimum PHP Version](https://img.shields.io/badge/php-%3E%3D%207.1-8892BF.svg?style=flat-square)](https://php.net/)

> PHPUnit is a unit testing framework for the PHP programming language. 
> It is an instance of the xUnit architecture for unit testing frameworks that 
> originated with SUnit and became popular with JUnit. PHPUnit was created by 
> Sebastian Bergmann and its development is hosted on GitHub.
> -- <cite>From Wikipedia, the free encyclopedia</cite>

## Packages

<?php
echo $ul;
