<?php

namespace Sphp\Html\Foundation\F6\Grids;

$rows[] = new Row("small-12");
$rows[] = new Row(["small-6", "small-6"]);
$rows[] = new Row(["small-4", "small-4", "small-4"]);
$rows[] = new Row(["small-3", "small-3", "small-3", "small-3"]);
$rows[] = new Row(["small-2", "small-2", "small-2", "small-2", "small-2", "small-2"]);
$rows[] = new Row(range(1, 12));

foreach($rows as $row) {
  $row->printHtml();
}

?>
