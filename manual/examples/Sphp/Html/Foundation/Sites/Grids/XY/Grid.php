<?php

namespace Sphp\Html\Foundation\Sites\Grids\XY;

$rows[] = new Row(["full"]);
$rows[] = Row::from(array_fill(0, 15, "auto"));
$rows[] = (new Row(array_fill(0, 2, "auto")))
        ->append(new Column('small-3', ['small-3']))
        ->append(new Column('small-3, large-5', ['small-3', 'large-5']));
$rows[] = new Row(array_fill(0, 4, "auto"));

Grid::from($rows)->printHtml();
