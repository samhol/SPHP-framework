<?php

namespace Sphp\Html\Foundation\F6\Core;

use Sphp\Html\Foundation\Content\Panel as Panel;
use Sphp\Html\Lists\LiInterface as Li;

$grid = (new BlockGrid())->setSmallBlockGrid(6);
foreach (VisibilityHandler::getScreenTypeMap() as $const => $name) {
	$grid[] = (new \Sphp\Html\Foundation\F6\Containers\Callout("show Only For $name"))
		->showOnlyFor($const);
}
$grid->printHtml();
?>