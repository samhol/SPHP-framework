<?php

namespace Sphp\Html\Apps\Calendars;

use Sphp\Html\Foundation\Sites\Containers\Accordions\CodeExampleAccordion;

$ns = $api->namespaceLink(__NAMESPACE__);
$monthView= $api->classLinker(MonthView::class);
echo $parsedown->text(<<<MD
##The $monthView component
MD
);
CodeExampleAccordion::visualize(EXAMPLE_DIR . "Sphp/Html/Apps/MonthView.php");
