<?php

namespace Sphp\DateTime;

use Sphp\Manual;

$dateTimeInterface = Manual\api()->classLinker(DateTimeInterface::class);
$date = Manual\api()->classLinker(Date::class);
$dateInterface = Manual\api()->classLinker(DateInterface::class);
$dateTimeLink = Manual\api()->classLinker(DateTime::class);
$namespaces = Manual\api()->namespaceBreadGrumbs(__NAMESPACE__);
$dateTimeImmutable = Manual\php()->classLinker(\DateTimeImmutable::class);
Manual\md(<<<MD
        
##Interfaces for dates and times
        
The $dateInterface interface
:  operations for dates

The $dateTimeInterface interface
:  operations for both dates and times like  for hours, minutes, seconds and timezones

##The $date and The $dateTimeLink classes
        
These classes are wrappers for PHP's native $dateTimeImmutable. 
        

The $date class implements $dateInterface. It ignores time units smaller than 
days (like hours, minutes and seconds).


The $dateTimeLink class introduces some new ways to compare datetimes.
MD
);

Manual\example('Sphp/DateTime/DateTimeInterface.php', 'text', false)
        ->setExamplePaneTitle("DateTime example")
        ->setOutputSyntaxPaneTitle("DateTime example results")
        ->printHtml();

