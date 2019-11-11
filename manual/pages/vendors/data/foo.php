<?php

use Sphp\Manual\MVC\Intro\PackageLinkListBuilder;
use Sphp\Stdlib\Arrays;
use Sphp\Stdlib\Parsers\ParseFactory;

$all = ParseFactory::fromFile('./composer.json');
$zends = Arrays::findKeysLike($all['require'], '/^((?!zendframework|php).)*$/');
$array = $all['require'];
    $keys = array_keys($array);
    $matchingKeys = preg_grep('/^((?!zendframework|php).)*$/', $keys);
    $filteredArray = array_intersect_key($array, array_flip($matchingKeys));
    print_r($filteredArray);
echo PackageLinkListBuilder::github()
        ->build($filteredArray);
