<?php

namespace Sphp\Html\Foundation\Sites\Grids;

$rows[] = new Row(["full"]);
$rows[] = Row::from(array_fill(0, 15, "auto"));
$rows[2] = (new Row(array_fill(0, 2, "auto")));
$rows[2]->append(new DivColumn('small-3', ['small-3']));
$rows[2]->append(new DivColumn('small-3, large-5', ['small-3', 'large-5']));
$rows[] = new Row(array_fill(0, 4, "auto"));

Grid::from($rows)->printHtml();
