<?php

namespace Sphp\Html\Foundation\Sites\Grids;

$col_1 = new DivColumn("1st", ['small-4', 'small-push-9']);
$col_2 = new DivColumn("2nd", ['small-2', 'small-push-3']);
$col_3 = new DivColumn("3rd", ['small-1', 'small-pull-3']);
$col_4 = new DivColumn("4th", ['small-5', 'small-pull-9']);

$row = new Row();
$row->append($col_1);
$row->append($col_2);
$row->append($col_3);
$row->append($col_4);
$row->printHtml();
