<?php

namespace Sphp\Html\Foundation\Sites\Grids\XY;

$rows[] = ["small-12"];
$rows[] = array_fill(0, 2, "small-6");
$rows[] = array_fill(0, 3, "small-4");
$rows[] = array_fill(0, 4, "small-3");
$rows[] = range(1, 6);
$rows[] = range(1, 12);

Grid::from($rows)->printHtml();
