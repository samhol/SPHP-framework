<?php

namespace Sphp\Html\Foundation\Sites\Grids;

$row1 = new Row();
$row1->appendColumn("1.1", ['small-4', 'medium-3']);
$row1->appendColumn("1.2", ['small-4', 'medium-6']);
$row1->appendColumn("1.3", ['small-4', 'medium-3']);

$row2 = new Row();
$row2->appendColumn("2.1", ['small-3', 'medium-2']);
$row2->appendColumn("2.2", ['small-3', 'medium-8']);
$row2->appendColumn("2.3", ['small-6', 'medium-2']);

$row3 = new Row();
$row3->appendColumn("3.1", ['small-4', 'medium-1']);
$row3->appendColumn("3.2", ['small-4', 'medium-10']);
$row3->appendColumn("3.3", ['small-4', 'medium-1']);

$grid = (new Grid())
        ->append($row1)
        ->append($row2)
        ->append($row3)
        ->append(new Row("4.1", ['small-3', 'medium-4', 'small-offset-2']))
        ->append(new Row("5.1", ['small-4', 'medium-4']))
        ->append(new Row("6.1", ['small-5', 'medium-4']));
$centered = new Column("7.1", ['small-3']);
$centered->layout()->centerize("small");

$grid->append($centered)
        ->printHtml();

