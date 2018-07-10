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
        
These classes are wrappers for native $dateTimeImmutable objects. 
        

The $date class implements $dateInterface. It ignores time units smaller than 
days (like hours, minutes and seconds).
MD
);

Manual\example("Sphp/DateTime/Date.php", "text", false)
        ->setExamplePaneTitle("Date examples")
        ->setOutputSyntaxPaneTitle("Date example results")
        ->printHtml();

Manual\md(<<<MD

The $dateTimeLink class is very similar with PHP's native $dateTimeImmutable class.

MD
);
Manual\example("Sphp/DateTime/DateTime.php", "text", false)
        ->setExamplePaneTitle("DateTime example")
        ->setOutputSyntaxPaneTitle("DateTime example results")
        ->printHtml();

$datePeriod = Manual\api()->classLinker(Period::class);

$phpDatePeriod = Manual\php()->classLinker(\DatePeriod::class);
Manual\md(<<<MD
##The $datePeriod class
        
This class extends PHP's native $phpDatePeriod and thus represents a date period.

A date period allows iteration over a set of dates and times, recurring at regular 
intervals, over a given period.
MD
);

Manual\example("Sphp/DateTime/DateRange.php", "text", false)
        ->setExamplePaneTitle("Period example")
        ->setOutputSyntaxPaneTitle("Period example results")
        ->printHtml();

$dateInterval = Manual\api()->classLinker(DateInterval::class);
$phpDateInterval = Manual\php()->classLinker(\DateInterval::class);

Manual\md(<<<MD
##The $dateInterval class
This class extends native $phpDateInterval class giving some new functionality to it.

A date interval stores either a fixed amount of time (in years, months, days, 
hours etc) or a relative time string in the format that DateTime's constructor supports.
       
	
MD
);

Manual\printPage('Sphp.DateTime.Calendars');
