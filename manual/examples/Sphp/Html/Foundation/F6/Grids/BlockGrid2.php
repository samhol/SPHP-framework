<?php

namespace Sphp\Html\Foundation\F6\Grids;

$grid = (new BlockGrid())->setBlockGrid(6, "small");
foreach (VisibilityHandler::getScreenTypeMap() as $const => $name) {
	$grid[] = (new \Sphp\Html\Foundation\F6\Containers\Callout("show Only For $name"))
		->showOnlyFor($const);
}
$grid->printHtml();
?>
