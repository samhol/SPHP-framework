<?php

namespace Sphp\Html\Apps\Calendars;

use Sphp\Html\Apps\Syntaxhighlighting\CodeExampleAccordionBuilder;

$ns = \Sphp\Manual\api()->namespaceLink(__NAMESPACE__);
$monthView = $api->classLinker(MonthView::class);
\Sphp\Manual\parseDown(<<<MD
##The $monthView component
MD
);
CodeExampleAccordionBuilder::visualize("Sphp/Html/Apps/Calendars/MonthView.php");
