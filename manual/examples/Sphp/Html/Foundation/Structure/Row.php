<?php

namespace Sphp\Html\Foundation\Structure;

$col = new Column("small-2 medium-4 large-6", 2, 4, 6);
$row1 = new Row(["small-6", "small-6"]);
$row2 = new Row(["small-4", "small-4", "small-4"]);
$row3 = (new Row())
		->setColumns(["small-5 medium-4 large-3", $col, "small-5 medium-4 large-3"]);
$row4 = new Row(range(1, 12));

$row1->printHtml();
$row2->printHtml();
$row3->printHtml();
$row4->printHtml();
?>