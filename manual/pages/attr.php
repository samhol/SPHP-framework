<?php

namespace Sphp\Html\Attributes;

echo '<pre>';
$gen = new \Sphp\Html\Attributes\AttributeGenerator();
$attrs = new \Sphp\Html\Attributes\AttributeManager($gen);

$attrs->getObjectMap()
        ->mapType('class', ClassAttribute::class)
        ->mapType('coords', \Sphp\Html\Media\ImageMap\CoordinateAttribute::class)
        ->mapType('style', PropertyCollectionAttribute::class)
        ->mapType('id', IdAttribute::class);
$attrs->setAttribute('class', 'foo');
$attrs->setAttribute('class', 'bar baz');
$attrs->getObject('class')->add('foo-bar');
$attrs->{'data-foo'}('foo-bar');
$attrs->id('foo-bar');
$attrs->{'data-true'} = true;
$attrs->{'data-false'} = false;
$attrs->coords = '1,2,3,4,5';

echo "\n$attrs";
$vals = ['1',[9,7000, ['shit']], 2, ' 2', 54, 'foo'];
$properties = new \stdClass();
$properties->type = 'float';
$properties->length = 3;
$properties->delim = ',';
$mvp = new MultiValueParser($properties);
var_dump($mvp->parseRawArray($vals));
var_dump($mvp->parseRaw('3,2,5,5,2,342,noob'));

use Sphp\Filters\ArrayFilter;

$arrFilter = new ArrayFilter;
$arrFilter->allowThese('foo');
echo '</pre>';

