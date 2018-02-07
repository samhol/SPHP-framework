<?php

namespace Sphp\Html\Apps\Calendars;

$ns = \Sphp\Manual\api()->namespaceLink(__NAMESPACE__);
$monthView = $api->classLinker(MonthView::class);
\Sphp\Manual\md(<<<MD
##The $monthView component
MD
);
\Sphp\Manual\visualize("Sphp/Html/Apps/Calendars/MonthView.php");
