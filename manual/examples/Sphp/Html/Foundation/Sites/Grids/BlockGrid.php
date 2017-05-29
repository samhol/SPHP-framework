<?php

namespace Sphp\Html\Foundation\Sites\Grids;

use Sphp\Html\Media\Img as Image;
use Sphp\Html\Media\Size as Size;

$img200 = Image::scaleToFit("manual/pics/skull.png", new Size(200, 200))->setLazy(true);
$img100 = Image::scaleToFit("manual/pics/skull.png", new Size(100, 100))->setLazy(true);
$img30 = Image::scaleToFit("manual/pics/skull.png", new Size(30, 30))->setLazy(true);
$grid = (new Grid());
$grid->append(new BlockGrid([$img200, $img200, $img200], ['small-up-1', 'medium-up-2', 'large-up-3']))
        ->append(new BlockGrid([$img100, $img100, $img100, $img100], ['small-up-2', 'medium-up-3', 'large-up-4']))
        ->append(new BlockGrid([$img30, $img30, $img30, $img30, $img30, $img30, $img30, $img30], ['small-up-4', 'medium-up-8']))
        ->append(new BlockGrid(range('a', 'h'), ['small-up-6','medium-up-8']));
foreach ($grid as $column) {
  $column->addCssClass("text-center");
}
$grid->printHtml();
