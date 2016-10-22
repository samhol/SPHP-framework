<?php

namespace Sphp\Html\Foundation\Sites\Grids;

$rows[] = new Row(["small-12"]);
$rows[] = new Row(array_fill(0, 2, "small-6"));
$rows[] = new Row(array_fill(0, 3, "small-4"));
$rows[] = new Row(array_fill(0, 4, "small-3"));
$rows[] = new Row(range(1, 6));
$rows[] = new Row(range(1, 12));

foreach($rows as $row) {
  $row->printHtml();
}

?>
