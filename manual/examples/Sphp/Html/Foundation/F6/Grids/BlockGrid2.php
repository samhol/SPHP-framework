<?php

namespace Sphp\Html\Foundation\Sites\Grids;

$grid = (new BlockGrid())->setBlockGrid(6, "small");
foreach (VisibilityHandler::getScreenTypeMap() as $const => $name) {
	$grid[] = (new \Sphp\Html\Foundation\Sites\Containers\Callout("show Only For $name"))
		->showOnlyFor($const);
}
$grid->printHtml();
?>
