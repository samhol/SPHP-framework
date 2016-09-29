<?php

namespace Sphp\Core\Filters;

$filters = new FilterAggregate();

$filters->addFilter(new TagStripper())
        ->addFilter(new StringTrimmer("_", true, false))
        ->addFilter(new StringTrimmer("_", false, true))
        ->addFilter(new StringTrimmer("*"))
        ->addFilter(new FilterAggregate(["mb_strtolower", "ucfirst"]));
echo $filters->filter("__*<b>BOLD</b>!!<br>*_") . " and ";
echo $filters("__<i>italic</i>__") . "\n";

return $filters;
?>
