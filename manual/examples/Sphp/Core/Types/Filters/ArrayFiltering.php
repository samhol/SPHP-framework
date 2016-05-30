<?php

namespace Sphp\Core\Types\Filters;

use Sphp\Core\Types\Arrays as Arrays;

$stringFilters = include("StringFiltering.php");

$arr = [
    2015 => 2015,
    "__name__"=> " saMi <strong> petteri__</strong> <b>HOLCK</b>",
    [
        "nested array",
        "__**__"]
];
$filters = new FilterAggregate();
$filters->addFilter($stringFilters)
        ->addFilter(new TrimFilter("__"))
        ->addFilter(new IntegerToRomanFilter())
        ->addFilter(new FilterAggregate(["mb_strtolower", "ucfirst"]));

print_r(Arrays::multiMap($filters, $arr));
?>