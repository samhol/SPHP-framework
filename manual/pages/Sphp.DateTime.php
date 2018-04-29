<?php

namespace Sphp\DateTime;

use Sphp\Manual;

$date = Manual\api()->classLinker(Date::class);
$namespaces = Manual\api()->namespaceBreadGrumbs(__NAMESPACE__);

Manual\md(<<<MD
#Date and Time
$namespaces
PHP has a variety of functions and classes that can handle dates. 
        
##$date
MD
);

Manual\example("Sphp/DateTime/Date.php", "text", false)
        ->setExamplePaneTitle("Date examples")
        ->setOutputSyntaxPaneTitle("Date example results")
        ->printHtml();

$dateRange = Manual\api()->classLinker(DateRange::class);
Manual\md(<<<MD
##$dateRange

MD
);

Manual\example("Sphp/DateTime/DateRange.php", "text", false)
        ->setExamplePaneTitle("DateRange examples")
        ->setOutputSyntaxPaneTitle("DateRange example results")
        ->printHtml();

Manual\md(<<<MD
##Easter dates
$namespaces
        
	
MD
);
Manual\example("Sphp/DateTime/Calendars/EasterCalendar.php", "text", false)
        ->setExamplePaneTitle("Date examples")
        ->setOutputSyntaxPaneTitle("Date example results")
        ->printHtml();

Manual\loadPage('Sphp.DateTime.Calendars');
