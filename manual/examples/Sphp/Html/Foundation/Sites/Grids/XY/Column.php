<?php

namespace Sphp\Html\Foundation\Sites\Grids;

$col_1 = new DivCell("1st", ['small-4', 'small-push-9']);
$col_2 = new DivCell("2nd", ['small-2', 'small-push-3']);
$col_3 = new DivCell("3rd", ['small-1', 'small-pull-3']);
$col_4 = new DivCell("4th", ['small-5', 'small-pull-9']);

$row = new BasicRow();
$row->append($col_1);
$row->append($col_2);
$row->append($col_3);
$row->append($col_4);
$row->printHtml();
