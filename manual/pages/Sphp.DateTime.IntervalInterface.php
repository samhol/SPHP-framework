<?php

namespace Sphp\DateTime;

use Sphp\Manual;

$intervalInterface = Manual\api()->classLinker(IntervalInterface::class);
$interval = Manual\api()->classLinker(Interval::class);
$phpDateInterval = Manual\php()->classLinker(\DateInterval::class);
$intervals = Manual\api()->classLinker(Intervals::class);
Manual\md(<<<MD
##The $interval class
The $interval class extends PHP's native
$phpDateInterval class and implements $intervalInterface.

An interval stores either a fixed amount of time (in years, months, days, 
hours etc) or a relative time string in the format that DateTime's constructor supports.

**Note:**
$intervals is factory for $interval objects. Interval objects can be created from 
other interval objects, strings and integers.

MD
);
Manual\example('Sphp/DateTime/Intervals.php', 'text', false)
        ->setExamplePaneTitle("Intervals factory example")
        ->setOutputSyntaxPaneTitle("Intervals factory results")
        ->printHtml();

