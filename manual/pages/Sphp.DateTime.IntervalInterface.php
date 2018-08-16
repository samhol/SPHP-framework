<?php

namespace Sphp\DateTime;

use Sphp\Manual;
$intervalInterface = Manual\api()->classLinker(IntervalInterface::class);
$interval = Manual\api()->classLinker(Interval::class);
$phpDateInterval = Manual\php()->classLinker(\DateInterval::class);

Manual\md(<<<MD
##The $interval class
The $interval class implements $intervalInterface. It also extends PHP's native
$phpDateInterval class giving some new functionality to it.

An interval stores either a fixed amount of time (in years, months, days, 
hours etc) or a relative time string in the format that DateTime's constructor supports.

MD
);

Manual\example('Sphp/DateTime/DateInterval.php', 'text', false)
        ->setExamplePaneTitle("Interval example")
        ->setOutputSyntaxPaneTitle("Interval example results")
        ->printHtml();

$intervals = Manual\api()->classLinker(Intervals::class);
Manual\md(<<<MD
##A factory for $interval objects
$intervals is factory for $interval objects. Interval objects can be created from other interval objects, strings and integers.

MD
);
Manual\example('Sphp/DateTime/Intervals.php', 'text', false)
        ->setExamplePaneTitle("Intervals factory example")
        ->setOutputSyntaxPaneTitle("Intervals factory results")
        ->printHtml();

