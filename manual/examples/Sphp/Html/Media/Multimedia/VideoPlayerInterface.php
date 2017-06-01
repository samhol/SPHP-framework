<?php

namespace Sphp\Html\Media\Multimedia;

use Sphp\Html\Media\Size;
use Sphp\Html\Foundation\Sites\Grids\BlockGrid;

$size = new Size(384, 216);
$grid = new BlockGrid(['small-up-1', 'medium-up-2', 'large-up-3']);
$grid->append((new YoutubePlayer("VjDnB9xWodM"))
                ->loop(false)
                ->setLazy()
                ->setSize($size));
$grid->append((new YoutubePlayer("wp6cnp1kZBY"))
        ->loop(true)
        ->setLazy()
        ->setSize($size));
$grid->append((new YoutubePlayer("o268qbb_0BM"))
        ->loop()
        ->setEndTime(5)
        ->setLazy()
        ->setSize($size));
$grid->append((new YoutubePlayer("PLC77007E23FF423C6", true))
        ->loop()
        ->setLazy()
        ->setSize($size));
$grid->append((new DailyMotionPlayer("x2p4pkp"))
        ->loop()
        ->setLazy()
        ->setSize($size));

$grid->printHtml();
