<?php

namespace Sphp\Html\Foundation\Structure;

use Sphp\Html\Foundation\Content\Panel as Panel;
use Sphp\Html\Lists\LiInterface as Li;

$grid = (new BlockGrid())->setSmallBlockGrid(6);
foreach (VisibilityHandler::getScreenTypeMap() as $const => $name) {
	$grid[] = (new Panel("show Only For $name"))
		->showOnlyFor($const);
}
$grid->printHtml();
?>