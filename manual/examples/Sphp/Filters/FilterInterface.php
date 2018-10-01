<?php

namespace Sphp\Filters;

$data = [2, 1, "5", 11, 1412];
$ordinalizer = new Ordinalizer();
$toRoman = new IntegerToRomanFilter();
foreach ($data as $val) {
  echo "$val, " . $ordinalizer($val) . ", " . $toRoman($val) . "\n";
}
$intFilter = Filters::int();
$intFilter->options->default = 1;
$intFilter->options->min_range = 0;
$intFilter->options->max_range = 10;

var_dump($intFilter->filter('-10a'));
var_dump($intFilter->filter(100));

$stringFilter = Filters::string();
