<?php

namespace Sphp\Filters;

$filters = new FilterAggregate();

$filters->addFilter(new TagStripper())
        ->addFilter(new FilterAggregate(["mb_strtolower", "ucfirst"]));
echo $filters->filter("__*<b>BOLD</b>!!<br>*_") . " and ";
echo $filters("__<i>italic</i>__") . "\n";

return $filters;
