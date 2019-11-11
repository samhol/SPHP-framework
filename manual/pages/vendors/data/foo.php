<?php

use Sphp\Manual\MVC\Intro\PackageLinkListBuilder;
use Sphp\Stdlib\Arrays;
use Sphp\Stdlib\Parsers\ParseFactory;

$all = ParseFactory::fromFile('./composer.json');
$zends = Arrays::findKeysLike($all['require'], 'zendframework');

$plb = PackageLinkListBuilder::github();

echo $plb->build($zends);