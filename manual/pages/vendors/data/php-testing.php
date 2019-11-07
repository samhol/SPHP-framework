<?php

namespace Sphp\Manual\Vendors;

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
# Unit testing SPHPlayground

PHP unit testing is done with PHPUnit. 

> PHPUnit is a unit testing framework for the PHP programming language. 
> It is an instance of the xUnit architecture for unit testing frameworks that 
> originated with SUnit and became popular with JUnit. PHPUnit was created by 
> Sebastian Bergmann and its development is hosted on GitHub.
> -- <cite>From Wikipedia, the free encyclopedia</cite>

## Packages

<?php
echo $ul;
