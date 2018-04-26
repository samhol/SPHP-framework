<?php

namespace Sphp\DateTime\Calendars;

use Sphp\Manual;

$calendarDate = Manual\api()->classLinker(CalendarDate::class);
$namespaces = Manual\api()->namespaceBreadGrumbs(__NAMESPACE__);

Manual\md(<<<MD
##Calendars
$namespaces
$calendarDate
        
	
MD
);

Manual\example("Sphp/DateTime/Calendars/CalendarDateBuilder.php", "text", false)
        ->setExamplePaneTitle("Date examples")
        ->setOutputSyntaxPaneTitle("Date example results")
        ->printHtml();
