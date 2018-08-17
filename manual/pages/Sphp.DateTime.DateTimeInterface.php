<?php

namespace Sphp\DateTime;

use Sphp\Manual;

$date = Manual\api()->classLinker(DateWrapper::class);
$dateInterface = Manual\api()->classLinker(DateInterface::class);
$timeInterface = Manual\api()->classLinker(TimeInterface::class);
$dateTimeInterface = Manual\api()->classLinker(DateTimeInterface::class);
$dateTimeLink = Manual\api()->classLinker(DateTimeWrapper::class);
$namespaces = Manual\api()->namespaceBreadGrumbs(__NAMESPACE__);
$dateTimeImmutable = Manual\php()->classLinker(\DateTimeImmutable::class);
$date = Manual\api()->classLinker(DateWrapper::class);
$dateInterface = Manual\api()->classLinker(DateInterface::class);
$dateTimeLink = Manual\api()->classLinker(DateTimeWrapper::class);
$namespaces = Manual\api()->namespaceBreadGrumbs(__NAMESPACE__);
$dateTimeImmutable = Manual\php()->classLinker(\DateTimeImmutable::class);
Manual\md(<<<MD
##The $date and The $dateTimeLink classes
        
These classes are wrappers for PHP's native $dateTimeImmutable. 
        

The $date class implements $dateInterface. It ignores time units smaller than 
days (like hours, minutes and seconds).
MD
);

Manual\md(<<<MD
        
##Interfaces for dates and times
        
The $dateInterface interface
:  operations for dates

The $timeInterface interface
:  operations for hours, minutes, seconds and timezones

The $dateTimeInterface interface
:  operations for both dates and times

MD
);
Manual\example('Sphp/DateTime/DateInterface.php', 'text', false)
        ->setExamplePaneTitle('Date examples')
        ->setOutputSyntaxPaneTitle('Date example results')
        ->printHtml();
Manual\md(<<<MD
##The $timeInterface interface
MD
);
Manual\example('Sphp/DateTime/TimeInterface.php', 'text', false)
        ->setExamplePaneTitle('Time example')
        ->setOutputSyntaxPaneTitle('Time example results')
        ->printHtml();
Manual\md(<<<MD
##The $dateTimeInterface interface
MD
);

Manual\example('Sphp/DateTime/DateTimeInterface.php', 'text', false)
        ->setExamplePaneTitle("DateTime example")
        ->setOutputSyntaxPaneTitle("DateTime example results")
        ->printHtml();
Manual\md(<<<MD
These classes are wrappers for PHP's native $dateTimeImmutable. 
        

The $date class implements $dateInterface. It ignores time units smaller than 
days (like hours, minutes and seconds).
MD
);

Manual\example('Sphp/DateTime/Factory.php', 'text', false)
        ->setExamplePaneTitle("Date examples")
        ->setOutputSyntaxPaneTitle("Date example results")
        ->printHtml();

Manual\md(<<<MD

The $dateTimeLink class is very similar with PHP's native $dateTimeImmutable class.

MD
);
Manual\md(<<<MD

The $dateTimeLink class introduces some new ways to compare datetimes.

MD
);
Manual\example('Sphp/DateTime/DateTime.compareTo.php', 'text', false)
        ->setExamplePaneTitle('DateTime comparison example')
        ->setOutputSyntaxPaneTitle('DateTime comparison results')
        ->printHtml();
