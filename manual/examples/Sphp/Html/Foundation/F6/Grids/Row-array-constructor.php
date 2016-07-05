<?php

namespace Sphp\Html\Foundation\F6\Grids;

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
