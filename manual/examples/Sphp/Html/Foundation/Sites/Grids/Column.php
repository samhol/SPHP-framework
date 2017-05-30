<?php

namespace Sphp\Html\Foundation\Sites\Grids;

$col_1 = new Column("1st", ['small-3', 'small-push-9']);
$col_2 = new Column("2nd", ['small-3', 'small-push-3']);
$col_3 = new Column("3rd", ['small-3', 'small-pull-3']);
$col_4 = new Column("4th", ['small-3', 'small-pull-9']);

(new Row())
        ->append($col_1)
        ->append($col_2)
        ->append($col_3)
        ->append($col_4)
        ->printHtml();
