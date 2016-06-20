<?php

namespace Sphp\Html\Foundation\F6\Grids;

$col_1 = new Column("col-1", 2, 4, 6, 8, 10);
$col_2 = new Column("col-2", 10, 8, 6, 4, 2);

$rows[] = new Row(range(1, 12));
$rows[] = new Row([$col_1, "small-10..."]);
$rows[] = new Row([$col_1, $col_2]);
$rows[] = new Row([$col_2, "small-2"]);

foreach($rows as $row) {
  $row->printHtml();
}
?>
