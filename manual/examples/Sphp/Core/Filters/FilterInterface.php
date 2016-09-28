<?php

namespace Sphp\Core\Filters;

$data = [-2, 0, "a", "5", 11, 1412];
$ordinalizer = new Ordinalizer();
$toRoman = new IntegerToRomanFilter();
foreach ($data as $val) {
  echo "$val, " . $ordinalizer($val) . ", " . $toRoman($val) . "\n";
}
?>
