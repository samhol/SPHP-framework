<?php

namespace Sphp\Html\Media\AV;

use Sphp\Html\Foundation\F6\Grids\BlockGrid as BlockGrid;

$srcs[] = "http://techslides.com/demos/sample-videos/small.mp4";
$srcs[] = "http://techslides.com/demos/sample-videos/small.3gp";
$srcs[] = "http://techslides.com/demos/sample-videos/small.webm";
$srcs[] = "http://techslides.com/demos/sample-videos/small.ogv";

$vjs[] = (new VideoJs($srcs))
        ->setPoster("manual/pics/LEGO_logo.png")
        ->setRatio("4-3");

$vjs[] = (new VideoJs("http://www.w3schools.com/html/mov_bbb.mp4"))
        ->addSource("http://www.w3schools.com/html/mov_bbb.ogg")
        ->loop(true)
        ->setWideScreen();

$blockGrid = (new BlockGrid($vjs, 1, 2))
        ->printHtml();
?>