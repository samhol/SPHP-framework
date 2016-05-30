<?php

namespace Sphp\Core\Types\Filters;

$filters = new FilterAggregate();
$filters->addFilter(new TagStripperFilter("<b>"))
		->addFilter(new TrimFilter("_ "))
		->addFilter(new IntegerToRomanFilter())
		->addFilter(new FilterAggregate(["mb_strtolower", "ucfirst"]));
echo $filters->filter("__<h1>sami</h1>__") . "\n";
echo $filters->filter("__<h1>2015</h1>__") . "\n";
?>