<?php

namespace Sphp\Html\Attributes;

echo '<pre>';
$gen = new \Sphp\Html\Attributes\AttributeGenerator();
$attrs = new \Sphp\Html\Attributes\AttributeManager($gen);


echo "\n$attrs";
$vals = ['1', 9, 7000, 'blöö', null, new \stdClass(), 2, ' 2', 54];
$properties = new \stdClass();
$properties->type = MultiValueParser::FLOAT;
$properties->length = 3;
$properties->delim = ',';
$mvp = new MultiValueParser($properties);
var_dump($mvp->validateArray($vals));
var_dump($mvp->parseRaw('3,2,5,5,2,342,noob'));

use Sphp\Filters\ArrayFilter;

$arrFilter = new ArrayFilter;
$arrFilter->allowThese('foo');
echo '</pre>';

