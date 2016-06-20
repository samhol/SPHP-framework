<?php

namespace Sphp\Html\Media;

use Sphp\Html\Foundation\F6\Grids\BlockGrid as BlockGrid;

$size = new Size(384, 216);

$player[] = (new YoutubePlayer("VjDnB9xWodM"))
        ->loop(false)
        ->setLazy()
        ->setSize($size);
$player[] = (new YoutubePlayer("wp6cnp1kZBY"))
        ->loop(true)
        ->setLazy()
        ->setSize($size);

$player[] = (new YoutubePlayer("o268qbb_0BM"))
        ->loop()
        ->setLazy()
        ->setSize($size);

$player[] = (new DailyMotionPlayer("x2p4pkp"))
        ->loop()
        ->setLazy()
        ->setSize($size);

$grid = (new BlockGrid($player, 2))->printHtml();
?>
