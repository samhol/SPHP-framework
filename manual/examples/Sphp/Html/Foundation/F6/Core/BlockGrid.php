<?php

namespace Sphp\Html\Foundation\F6\Core;

use Sphp\Html\Media\Img as Image;
use Sphp\Html\Media\Size as Size;
use Sphp\Html\Foundation\F6\Core\Screen as Screen;

$img200 = Image::scaleToFit("manual/pics/skull.png", new Size(200, 200))->setLazy(true);
$img100 = Image::scaleToFit("manual/pics/skull.png", new Size(100, 100))->setLazy(true);
$img30 = Image::scaleToFit("manual/pics/skull.png", new Size(30, 30))->setLazy(true);
$grid = (new Grid());
$grid->append(new BlockGrid([$img200, $img200, $img200], 1, 2, 3))
        ->append(new BlockGrid([$img100, $img100, $img100, $img100], 2, 3, 4))
        ->append(new BlockGrid([$img30, $img30, $img30, $img30, $img30, $img30, $img30, $img30], 4, 8, 8))
        ->append((new BlockGrid(range('a', 'h')))
                ->setBlockGrid(6, Screen::SMALL)
                ->setMediumBlockGrid(BlockGrid::MAX_GRID));
foreach ($grid as $column) {
  $column->addCssClass("text-center");
}
$grid->printHtml();
?>
