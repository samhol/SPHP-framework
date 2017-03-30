<?php

namespace Sphp\Html\Apps\Calendars;

use Sphp\Html\Apps\Syntaxhighlighting\CodeExampleBuilder;

$ns = $api->namespaceLink(__NAMESPACE__);
$monthView = $api->classLinker(MonthView::class);
echo $parsedown->text(<<<MD
##The $monthView component
MD
);
CodeExampleBuilder::visualize("Sphp/Html/Apps/Calendars/MonthView.php");
