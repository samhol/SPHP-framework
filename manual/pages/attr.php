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




echo '</pre>';

