<?php

namespace Sphp\Html\Foundation\Sites\Grids;

$row1 = new Row();
$row1->appendColumn("1.1", 4);
$row1->appendColumn("1.2", 4);
$row1->appendColumn("1.3", 4);

$row2 = new Row();
$row2->appendColumn("2.1", 3);
$row2->appendColumn("2.2", 6);
$row2->appendColumn("2.3", 3);

$row3 = new Row();
$row3->appendColumn("3.1", 2);
$row3->appendColumn("3.2", 8);
$row3->appendColumn("3.3", 2);

(new Grid())
        ->append($row1)
        ->append($row2)
        ->append($row3)
        ->append([new Column("4.1", 3), "4.2"])
        ->append([new Column("5.1", 4), "5.2"])
        ->append([new Column("6.1", 5), "6.2"])
        ->append((new Column("7.1", 3, 5, 7))
                ->centerize("medium"))
        ->append((new Column("8.1", 8))->setGridOffset(3))
        ->printHtml();
?>
