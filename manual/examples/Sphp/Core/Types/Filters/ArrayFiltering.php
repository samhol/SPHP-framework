<?php

namespace Sphp\Core\Filters;

use Sphp\Core\Types\Arrays;

$stringFilters = include("StringFiltering.php");

$arr = [
    "year" => 2015,
    "name" => " saMi <strong> petteri__</strong> <b>HOLCK</b>",
    [
        "nested array",
        "__*foo*__"]
];
$filters = new FilterAggregate();
$filters->addFilter($stringFilters)
        ->addFilter(new TrimFilter("__"))
        ->addFilter(new IntegerToRomanFilter())
        ->addFilter(new FilterAggregate(["mb_strtolower", "ucfirst"]));

print_r(Arrays::multiMap($filters, $arr));
?>
