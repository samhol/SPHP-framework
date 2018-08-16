<?php

namespace Sphp\DateTime;

use Sphp\Manual;

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

