<?php

namespace Sphp\Html\Foundation\F6\Grids;

$rows[] = new Row([1]);
$rows[] = new Row(range(1, 2));
$rows[] = new Row(range(1, 3));
$rows[] = new Row(range(1, 4));
$rows[] = new Row(range(1, 6));
$rows[] = new Row(range(1, 12));

foreach($rows as $row) {
  $row->printHtml();
}

?>
