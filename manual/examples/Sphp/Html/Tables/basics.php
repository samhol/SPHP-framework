<?php

namespace Sphp\Html\Tables;
use Sphp\Html\Foundation\Sites\Grids\Row as Row;

$table = (new Table("Table 1:"));
$body = $table->tbody();
$thead = $table->thead();
$foot = $table->tfoot();
$thead[] = [(new Th("th1"))->setStyle("border", "solid 2px red"), new Th("th2"), "th3"];
$thead->prepend(["1st", "2nd", "3rd"]);
$body[] = ["4", "5", "6"];
$body->prepend(["1", "2", "3"]);
$foot[] = new Th("Footer", "colgroup", 3);

$table2 = (new Table("Table 2:"));
$table2->clearContent()->setCaption("Table 2:");
$table2->tbody()[] = ["1st", "2nd", "3rd"];
$table2->tbody()->append(["v1", "v2", "v3"]);
$table2->tbody()[] = ["v4", "v5", "v6"];

(new Row([$table, $table2]))->printHtml();

?>
