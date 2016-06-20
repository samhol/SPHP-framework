<?php

namespace Sphp\Html\Foundation\F6\Grids;

$grid = new Grid();

$col = new Column("small-2 medium-4 large-6", 2, 4, 6);

$grid[] = $col;
$grid[] = ["small-6", "small-6"];
$grid[] = ["small-4", "small-4", "small-4"];
$grid[] = ["small-5 medium-4 large-3", $col, "small-5 medium-4 large-3"];
$grid[] = range(1, 12);

$grid->printHtml();
?>
