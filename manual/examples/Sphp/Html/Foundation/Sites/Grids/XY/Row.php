<?php

namespace Sphp\Html\Foundation\Sites\Grids;

echo BasicRow::from(['full']);
echo BasicRow::from(array_fill(0, 15, 'auto'));
$row = BasicRow::from(array_fill(0, 3, 'auto'));
$row->append(new DivCell('small-4', ['small-4']));
$row->append(new DivCell('small-4, large-5'))
        ->layout()
        ->setLayouts('small-4', 'large-5');
echo $row;
echo new BasicRow(array_fill(0, 4, 'auto'));
