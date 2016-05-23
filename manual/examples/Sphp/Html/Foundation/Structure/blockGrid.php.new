<?php

namespace Sphp\Html\Foundation\Structure;

use Sphp\Html\Media\Img as Image;
use Sphp\Html\Lists\LiInterface as Li;
use Sphp\Html\Media\Size as Size;

$img100 = Image::scaleToFit("sphpManual/pics/skull.png", new Size(100, 100))->setLazy();
$img30 = Image::scaleToFit("sphpManual/pics/skull.png", new Size(30, 30))->setLazy();
$grid = (new Grid());
$grid[] = new BlockGrid([$img100, $img100, $img100, $img100], 2, 3, 4);
$grid[] = new BlockGrid([$img30, $img30, $img30, $img30, $img30, $img30, $img30, $img30], 4, 8, 8);
$grid[] = (new BlockGrid(range('a', 'l')))
		->setBlockGrid(6, Screen::SMALL)
		->setMediumBlockGrid(BlockGrid::MAX_GRID);
foreach ($grid->getComponentsByObjectType(Li::class) as $column) {
	$column->addCssClass("panel text-center");
}
$grid->printHtml();
?>