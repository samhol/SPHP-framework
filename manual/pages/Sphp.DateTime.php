<?php

namespace Sphp\DateTime;

use Sphp\Manual;

$date = Manual\api()->classLinker(Date::class);
$dateInterface = Manual\api()->classLinker(DateInterface::class);
$dateTimeLink = Manual\api()->classLinker(DateTime::class);
$namespaces = Manual\api()->namespaceBreadGrumbs(__NAMESPACE__);
$dateTimeImmutable = Manual\php()->classLinker(\DateTimeImmutable::class);
Manual\md(<<<MD
#Date and Time
$namespaces
PHP has a variety of functions and classes that can handle date andd time related 
operations. This namespace introduces some addons to these native properties.
        
##The $date and The $dateTimeLink classes
        
These classes are wrappers for PHP's native $dateTimeImmutable. 
        

The $date class implements $dateInterface. It ignores time units smaller than 
days (like hours, minutes and seconds).
MD
);

Manual\example('Sphp/DateTime/Factory.php', 'text', false)
        ->setExamplePaneTitle("Date examples")
        ->setOutputSyntaxPaneTitle("Date example results")
        ->printHtml();
Manual\example('Sphp/DateTime/Date.php', 'text', false)
        ->setExamplePaneTitle("Date examples")
        ->setOutputSyntaxPaneTitle("Date example results")
        ->printHtml();

Manual\md(<<<MD

The $dateTimeLink class is very similar with PHP's native $dateTimeImmutable class.

MD
);
Manual\example('Sphp/DateTime/DateTime.php', 'text', false)
        ->setExamplePaneTitle("DateTime example")
        ->setOutputSyntaxPaneTitle("DateTime example results")
        ->printHtml();
Manual\md(<<<MD

The $dateTimeLink class introduces some new ways to compare datetimes.

MD
);
Manual\example('Sphp/DateTime/DateTime.compareTo.php', 'text', false)
        ->setExamplePaneTitle('DateTime comparison example')
        ->setOutputSyntaxPaneTitle('DateTime comparison results')
        ->printHtml();
$period = Manual\api()->classLinker(Period::class);

$phpDatePeriod = Manual\php()->classLinker(\DatePeriod::class);
Manual\md(<<<MD
##The $period class
        
This class extends PHP's native $phpDatePeriod and thus represents a date period.

A date period allows iteration over a set of dates and times, recurring at regular 
intervals, over a given period.
MD
);

Manual\example('Sphp/DateTime/Period.php', 'text', false)
        ->setExamplePaneTitle('Weeks of month example')
        ->setOutputSyntaxPaneTitle('Weeks of month example results')
        ->printHtml();
$periods = Manual\api()->classLinker(Periods::class);
Manual\md(<<<MD
###A factory for $period objects
$periods is factory for $period objects.

MD
);

Manual\example('Sphp/DateTime/Periods.php', 'text', false)
        ->setExamplePaneTitle("Periods factory example")
        ->setOutputSyntaxPaneTitle("Periods factory results")
        ->printHtml();

$interval = Manual\api()->classLinker(Interval::class);
$phpDateInterval = Manual\php()->classLinker(\DateInterval::class);

Manual\md(<<<MD
##The $interval class
This class extends PHP's native $phpDateInterval class giving some new functionality to it.

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

