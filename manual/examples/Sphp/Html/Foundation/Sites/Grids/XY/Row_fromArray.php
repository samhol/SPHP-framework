<?php

namespace Sphp\Html\Foundation\Sites\Grids\XY;

$rows[] = new Row(["small-12"]);
$rows[] = Row::from(array_fill(0, 15, "auto"));
$rows[] = (new Row(array_fill(0, 3, "auto")))->append(new Column('small-4', ['small-4']));
$rows[] = new Row(array_fill(0, 4, "small-3"));
$rows[] = Row::from(range(1, 6));
$rows[] = new Row(range(1, 12));

foreach ($rows as $row) {
  $row->printHtml();
}
