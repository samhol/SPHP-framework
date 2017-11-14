<?php

namespace Sphp\Html\Foundation\Sites\Grids;

$col_1 = new Column("first", ['small-2', 'medium-4', 'large-6', 'xlarge-8', 'xxlarge-10']);
$col_2 = new Column("second", ['small-10', 'medium-8', 'large-6', 'xlarge-4', 'xxlarge-2']);

(new Row())
        ->append($col_1)
        ->append($col_2)
        ->printHtml();
