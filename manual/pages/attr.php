<?php

namespace Sphp\Html\Attributes;

echo '<pre>';
$gen = new \Sphp\Html\Attributes\AttributeGenerator();
$attrs = new \Sphp\Html\Attributes\AttributeManager($gen);


echo "\n$attrs classes:\n";
$vals = ['1', 9, 7000, 'blöö', null, new \stdClass(), 2, ' 2', 54];
$vals1 = ['1', 9, 7000, true, 2, ' 2', 54, '1e10'];
$properties = new \stdClass();
$properties->type = MultiValueParser::FLOAT;
$properties->length = [7, 9];
$properties->delim = ',';

use Sphp\Stdlib\Parsers\Variables;
use Sphp\Html\Attributes\CssClassParser;

$classParser = new CssClassParser();

var_dump($classParser($vals1, false));
var_dump($classParser('foo bar _2baz baz-2aa--', true));
var_dump($classParser([['a', 'b', ['c']], 'foo bar _2baz baz-2aa--'], true));
try {

  var_dump(Variables::parseScalar(new \Sphp\Stdlib\MbString('mbstring')), Variables::parseScalar(false), Variables::parseScalar(1));
} catch (\Exception $ex) {
  echo $ex;
}
$mvp = new MultiValueParser($properties);
$mvp->setRange(7, 9);
try {
  var_dump($mvp->filter($vals1));
} catch (\Exception $ex) {
  echo $ex;
}try {
  var_dump($mvp->filter(',,,3,2,5,5,2,342,,'));
} catch (\Exception $ex) {
  echo $ex;
}

use Sphp\Filters\ArrayFilter;

$arrFilter = new ArrayFilter;
$arrFilter->allowThese('foo');
echo '</pre>';

