<?php

namespace Sphp\Core\Types\Filters;

use Sphp\Core\Types\Strings as Strings;

$filters = new FilterAggregate();

$filters->addFilter(new TagStripperFilter())
        ->addFilter(new TrimFilter("_", "left"))
        ->addFilter(new TrimFilter("!_", "right"))
        ->addFilter(new TrimFilter("*", "both"))
        ->addFilter(new IntegerToRomanFilter())
        ->addFilter(new FilterAggregate(["mb_strtolower", "ucfirst"]))
        ->addFilter(function ($string) {
          return Strings::regexReplace($string, "__", "");
        });
echo $filters->filter("__*<h1>sami holck</h1>*!_") . "\n";
echo $filters->filter("__<h1>2015</h1>__") . "\n";

return $filters;
?>
