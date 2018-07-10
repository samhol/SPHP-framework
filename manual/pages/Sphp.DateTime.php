<?php

namespace Sphp\DateTime;

use Sphp\Manual;

$date = Manual\api()->classLinker(Date::class);
$dateTimeLink = Manual\api()->classLinker(DateTime::class);
$namespaces = Manual\api()->namespaceBreadGrumbs(__NAMESPACE__);
$dateTimeImmutable = Manual\php()->classLinker(\DateTimeImmutable::class);
Manual\md(<<<MD
#Date and Time
$namespaces
PHP has a variety of functions and classes that can handle dates. 
        
##The $date and The $dateTimeLink classes
        
These classes implement kind of wrappers for native $dateTimeImmutable objects. 

The $date class  ignores units smaller than days.
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

$dateRange = Manual\api()->classLinker(Period::class);
Manual\md(<<<MD
##The $dateRange class

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
