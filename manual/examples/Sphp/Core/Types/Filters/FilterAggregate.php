<?php

namespace Sphp\Core\Filters;

$arr = ["a", -2, 4, 2.34, 1002];

$filters = new FilterAggregate();
$filters->addFilter(new AnythingToInteger(1))
        ->addFilter(function($variable) {
          return $variable * 2;
        })
        ->addFilter(new FilterAggregate(["abs"]))
        ->addFilter(new IntegerToRomanFilter());
$collectionFilter = new CollectionFilterAggregate($filters);
print_r($collectionFilter($arr));
?>
