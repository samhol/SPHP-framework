<?php

namespace Sphp\Filters;

$arr = [0, "a", -2, 4, 8.64, 1002];

$filters = new FilterAggregate();
$filters->addFilter(new IntegerFilter(2))
        ->addFilter(function($variable) {
          return $variable * 2;
        })
        ->addFilter("abs");
        //->addFilter(new IntegerToRomanFilter());
$collectionFilter = new CollectionFilterAggregate($filters);
print_r($collectionFilter($arr));
?>
