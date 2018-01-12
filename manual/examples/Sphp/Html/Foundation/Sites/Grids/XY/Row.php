<?php

namespace Sphp\Html\Foundation\Sites\Grids;

echo new Row(["full"]);
echo Row::from(array_fill(0, 15, "auto"));
$row = new Row(array_fill(0, 3, "auto"));
$row->append(new Column('small-4', ['small-4']));
$row->append(new Column('small-4, large-5'))
        ->layout()
        ->setLayouts('small-4', 'large-5');
echo $row;
echo new Row(array_fill(0, 4, "auto"));
