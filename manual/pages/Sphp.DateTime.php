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

Manual\printPage('Sphp.DateTime.DateTimeInterface');
Manual\example('Sphp/DateTime/DateInterface.php', 'text', false)
        ->setExamplePaneTitle("Date examples")
        ->setOutputSyntaxPaneTitle("Date example results")
        ->printHtml();

Manual\md(<<<MD

The $dateTimeLink class is very similar with PHP's native $dateTimeImmutable class.

MD
);
Manual\example('Sphp/DateTime/DateTimeInterface.php', 'text', false)
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

Manual\printPage('Sphp.DateTime.PeriodInterface');
Manual\printPage('Sphp.DateTime.IntervalInterface');
