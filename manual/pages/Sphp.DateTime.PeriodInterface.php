<?php

namespace Sphp\DateTime;

use Sphp\Manual;

$period = Manual\api()->classLinker(Period::class);
$phpDatePeriod = Manual\php()->classLinker(\DatePeriod::class);
$periods = Manual\api()->classLinker(Periods::class);

Manual\md(<<<MD
## The $period class
        
This class extends PHP's native $phpDatePeriod and thus represents a date period.
A date period allows iteration over a set of dates and times, recurring at regular 
intervals, over a given period.

**Note:** $periods is a factory for $period objects.

MD
);

Manual\example('Sphp/DateTime/Periods.php', 'text', false)
        ->setExamplePaneTitle('Factoring Weeks of month code')
        ->setOutputSyntaxPaneTitle('Periods factory results')
        ->printHtml();

