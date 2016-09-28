<?php

namespace Sphp\Core\Filters;

$filters = new FilterAggregate();

$filters->addFilter(new TagStripper("<b>"))
        ->addFilter(new TrimFilter("_", true, false))
        ->addFilter(new TrimFilter("!!", false, true))
        ->addFilter(new TrimFilter("*"))
        ->addFilter(new FilterAggregate(["mb_strtolower", "ucfirst"]));
echo $filters->filter("__*<b>BOLD</b>!!<br>*_") . "\n";
echo $filters("__<i>italic</i>__") . "\n";

return $filters;
?>
