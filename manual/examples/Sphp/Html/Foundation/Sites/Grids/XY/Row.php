<?php

namespace Sphp\Html\Foundation\Sites\Grids\XY;

$rows[] = new Row(["full"]);
$rows[] = Row::from(array_fill(0, 15, "auto"));
$rows[] = (new Row(array_fill(0, 3, "auto")))
        ->append(new Column('small-4', ['small-4']))
        ->append(new Column('small-4, large-5', ['small-4', 'large-5']));
$rows[] = new Row(array_fill(0, 4, "auto"));

foreach ($rows as $row) {
  $row->printHtml();
}
