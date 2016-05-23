<?php

namespace Sphp\Html\Tables;

$table = new Table("&lt;caption&gt;");
$table->thead()[] = array_fill(0, 4, "&lt;head&gt;");
$table->tbody()[] = array_fill(0, 4, "&lt;body&gt;");
$table->tbody()[] = array_fill(0, 4, "&lt;foot&gt;");
$table->tbody()[] = (new Td("&lt;td colspan=4&gt;"))->setColspan(4);
$table->tfoot()[] = array_fill(0, 4, "&lt;foot&gt;");
$table->printHtml();

?>
