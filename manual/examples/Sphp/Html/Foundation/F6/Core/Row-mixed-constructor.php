<?php

namespace Sphp\Html\Foundation\F6\Core;

$col_2_4_6 = new Column("small-2 medium-4 large-6", 2, 4, 6);
$col_10_8_6 = new Column("small-10 medium-8 large-6", 10, 8, 6);
$rows[] = new Row(["small-5 medium-4 large-3", "small-5 medium-4 large-3", $col_2_4_6]);
$rows[] = new Row(["small-4", "small-4", "small-4"]);
$rows[] = (new Row())
		->setColumns(["small-1 medium-2 large-3", $col_10_8_6, "small-1 medium-2 large-3"]);
$rows["baseline"] = new Row(range(1, 12));

foreach($rows as $row) {
  $row->printHtml();
}
?>