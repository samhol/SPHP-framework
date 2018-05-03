<?php

namespace Sphp\Html\DateTime\Calendars;

$ns = \Sphp\Manual\api()->namespaceBreadGrumbs(__NAMESPACE__);
$monthView = \Sphp\Manual\api()->classLinker(MonthView::class);
\Sphp\Manual\md(<<<MD
##Calendar components
$ns
###The $monthView component
MD
);
\Sphp\Manual\visualize('Sphp/Html/DateTime/Calendars/MonthView.php');

$dateStamp = \Sphp\Manual\api()->classLinker(DateStamp::class);
\Sphp\Manual\md(<<<MD
###The $dateStamp component
MD
);

\Sphp\Manual\visualize('Sphp/Html/DateTime/Calendars/DateStamp.php');
