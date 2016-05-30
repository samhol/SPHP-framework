<?php

namespace Sphp\Core\Types\Filters;

use Sphp\Core\Types\Arrays as Arrays;

$arr = [
	2015 => 2015,
	" saMi ", 
	"<strong> petteri__</strong>", 
	"<b>HOLCK</b>", 
	[
		"nested array", 
		"__**__"]
	];
$filters = new FilterAggregate();
$filters->addFilter(new TagStripperFilter("<b>"))
		->addFilter(new TrimFilter("_ "))
		->addFilter(new IntegerToRomanFilter())
		->addFilter(new FilterAggregate(["mb_strtolower", "ucfirst"]));

print_r(Arrays::multiMap($filters, $arr));
?>