<?php

namespace Sphp\Html\Apps\Calendars;

$ns = \Sphp\Manual\api()->namespaceLink(__NAMESPACE__);
$monthView = \Sphp\Manual\api()->classLinker(MonthView::class);
\Sphp\Manual\md(<<<MD
##The $monthView component
MD
);
\Sphp\Manual\visualize("Sphp/Html/Apps/Calendars/MonthView.php");

use Sphp\Html\Apps\DateStamp;
$dateStamp = \Sphp\Manual\api()->classLinker(DateStamp::class);
\Sphp\Manual\md(<<<MD
##The $dateStamp component
MD
);

\Sphp\Manual\visualize("Sphp/Html/Apps/Calendars/DateStamp.php");
