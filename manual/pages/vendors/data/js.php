# Client side JavaScript


## Included packages

<?php

use Sphp\Stdlib\Parsers\ParseFactory;
use Sphp\Manual\MVC\Intro\PackageLinkListBuilder;

$all = ParseFactory::fromFile('./package.json');


$plb = PackageLinkListBuilder::npm();

echo $plb->build($all['dependencies']);
