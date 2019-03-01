<?php

namespace Sphp\Html\Foundation\Sites\Grids;

$rows[] = new BasicRow(["full"]);
$rows[] = BasicRow::from(array_fill(0, 15, "auto"));
$rows[2] = (new BasicRow(array_fill(0, 2, "auto")));
$rows[2]->append(new ContainerCell('small-3', ['small-3']));
$rows[2]->append(new ContainerCell('small-3, large-5', ['small-3', 'large-5']));
$rows[] = new BasicRow(array_fill(0, 4, "auto"));

DivGrid::from($rows)->printHtml();
