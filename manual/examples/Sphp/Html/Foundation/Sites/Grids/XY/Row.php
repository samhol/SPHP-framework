<?php

namespace Sphp\Html\Foundation\Sites\Grids;

echo Row::from(['full']);
echo Row::from(array_fill(0, 15, 'auto'));
$row = Row::from(array_fill(0, 3, 'auto'));
$row->append(new DivColumn('small-4', ['small-4']));
$row->append(new DivColumn('small-4, large-5'))
        ->layout()
        ->setLayouts('small-4', 'large-5');
echo $row;
echo new Row(array_fill(0, 4, 'auto'));
