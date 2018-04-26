<?php

namespace Sphp\DateTime;

use Sphp\Manual;

$filterInterface = Manual\api()->classLinker(Date::class);
$namespaces = Manual\api()->namespaceBreadGrumbs(__NAMESPACE__);

Manual\md(<<<MD
#Date and Time
$namespaces
PHP has a variety of functions and classes that can handle dates. 
        
	
MD
);

Manual\example("Sphp/DateTime/Date.php", "text", false)
        ->setExamplePaneTitle("Date examples")
        ->setOutputSyntaxPaneTitle("Date example results")
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
