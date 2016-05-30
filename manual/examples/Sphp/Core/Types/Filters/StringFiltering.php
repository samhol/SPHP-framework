<?php

namespace Sphp\Core\Types\Filters;

use Sphp\Core\Types\Strings as Strings;

$filters = new FilterAggregate();
$replace = function ($string) {
  return Strings::regexReplace($string, "__", "");
};
$filters->addFilter(new TagStripperFilter())
        ->addFilter(new TrimFilter("_"))
        ->addFilter(new IntegerToRomanFilter())
        ->addFilter(new FilterAggregate(["mb_strtolower", "ucfirst"]))
        ->addFilter($replace);
echo $filters->filter("__<h1>sami holck</h1>__") . "\n";
echo $filters->filter("__<h1>2015</h1>__") . "\n";

return $filters;
?>
