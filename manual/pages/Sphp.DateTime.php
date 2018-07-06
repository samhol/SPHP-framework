<?php

namespace Sphp\DateTime;

use Sphp\Manual;

$date = Manual\api()->classLinker(Date::class);
$dateTimeLink = Manual\api()->DateTime;
$namespaces = Manual\api()->namespaceBreadGrumbs(__NAMESPACE__);

Manual\md(<<<MD
#Date and Time
$namespaces
PHP has a variety of functions and classes that can handle dates. 
        
##$date and 
MD
);

Manual\example("Sphp/DateTime/Date.php", "text", false)
        ->setExamplePaneTitle("Date examples")
        ->setOutputSyntaxPaneTitle("Date example results")
        ->printHtml();
Manual\example("Sphp/DateTime/DateTime.php", "text", false)
        ->setExamplePaneTitle("Date examples")
        ->setOutputSyntaxPaneTitle("Date example results")
        ->printHtml();

$dateRange = Manual\api()->classLinker(Period::class);
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

Manual\printPage('Sphp.DateTime.Calendars');
