<?php

namespace Sphp\Html\Media\AV;

use Sphp\Html\Media\Size as Size;
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
        ->setEndTime(5)
        ->setLazy()
        ->setSize($size);

$player[] = (new YoutubePlayer("PLC77007E23FF423C6", true))
        ->loop()
        ->setLazy()
        ->setSize($size);

$player[] = (new DailyMotionPlayer("x2p4pkp"))
        ->loop()
        ->setLazy()
        ->setSize($size);

$grid = (new BlockGrid($player, 1, 2, false, 3))->printHtml();
?>
