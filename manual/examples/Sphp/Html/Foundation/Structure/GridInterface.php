<?php

namespace Sphp\Html\Foundation\Structure;

$grid = (new Grid());
$grid[0] = ["first column", "second column"];
$grid[1] = new Row(array("first column", "second column", "third column"));
$grid[1] = new Row(["first column", new Column("second column [2, 4, 6]", 2, 4, 6), "third column"]);
$grid[2] = (new Row())->appendColumn("small-3 medium-5 large-7 small-centered", 3, 5, 7);
$grid[2][0]->centerize("small");
$grid[3] = new Row();
$grid[3]->append((new Column("single column with grid offset", 8))->setGridOffset(3));
$grid[4] = new Row(range(1, 12));
foreach ($grid->getColumns() as $column) {
	$column->addCssClass("bordered text-center");
}
$grid->printHtml();
?>