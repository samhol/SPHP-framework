<?php

namespace Sphp\Html\Foundation\Sites\Grids\XY;

$rows[] = ["small-12"];
$rows[] = array_fill(0, 2, "small-6");
$rows[] = array_fill(0, 3, "small-4");
$rows[] = array_fill(0, 4, "small-3");
$rows[] = range(1, 6);
$rows[] = range(1, 12);

Grid::from($rows)->printHtml();


var_dump(preg_match('/^((small|medium|large|xlarge|xxlarge)-([1-9]|(1[0-2])|auto)|auto)+$/', 'small-3', $matches, PREG_OFFSET_CAPTURE));
