<?php

namespace Sphp\Html\Media\Multimedia;

use Sphp\Html\Foundation\Sites\Grids\BlockGrid;

$srcs[] = "http://techslides.com/demos/sample-videos/small.mp4";
$srcs[] = "http://techslides.com/demos/sample-videos/small.3gp";
$srcs[] = "http://techslides.com/demos/sample-videos/small.webm";
$srcs[] = "http://techslides.com/demos/sample-videos/small.ogv";

$vjs[] = (new VideoJs($srcs))
        ->showControls()
        ->setPoster("manual/pics/LEGO_logo.png")
        ->setRatio("4-3");

$vjs[] = (new VideoJs("http://www.w3schools.com/html/mov_bbb.mp4"))
        ->addSource("http://www.w3schools.com/html/mov_bbb.ogg")
        ->showControls()
        ->loop(true)
        ->setWideScreen();

$blockGrid = (new BlockGrid(['small-up-1', 'large-up-3'],[$vjs]))
        ->printHtml();
