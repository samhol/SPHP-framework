<?php

namespace Sphp\Html\Foundation\F6\Core;

use Sphp\Html\Foundation\F6\Core\Screen as Screen;

$grid = (new Grid());
$grid[] = ["small-12"];
$grid[] = ["small-6", "small-6"];
$grid[] = ["small-4", "small-4", "small-4"];
$grid[] = new Row(["first column", new Column("small-2 medium-4 large-6", 2, 4, 6), "third column"]);
$grid["centered"] = (new Row())->appendColumn("small-3 medium-5 large-7 small-centered", 3, 5, 7);

$grid["centered"][0]->centerize(Screen::SMALL);
$grid["append"] = new Row();
$grid["append"]->append((new Column("single column with grid offset", 8))->setGridOffset(3));
$grid["1-12"] = new Row(range(1, 12));

$grid->printHtml();
?>