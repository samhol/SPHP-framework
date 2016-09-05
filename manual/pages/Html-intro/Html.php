<?php

namespace Sphp\Html;

use Sphp\Html\Apps\Manual\Apis as Apis;
use Sphp\Html\Foundation\F6\Grids\BlockGrid as BlockGrid;

$ns = Apis::apigen()->namespaceBreadGrumbs(__NAMESPACE__);
$videoJs = Apis::apigen()->classLinker(VideoJs::class);
echo <<<MD
##`HTML` components

$ns
  
The HTML namespace contains mobile friendly customizable UI 
components compatibile with most web browsers and devices. Most UI components are 
based on Foundation frontend framework. 
  

###$videoJs example:

<div class="example-area">  
MD
;

$srcs[] = "http://techslides.com/demos/sample-videos/small.mp4";
$srcs[] = "http://techslides.com/demos/sample-videos/small.3gp";
$srcs[] = "http://techslides.com/demos/sample-videos/small.webm";
$srcs[] = "http://techslides.com/demos/sample-videos/small.ogv";

$vjs[] = (new VideoJs($srcs))
        ->setPoster("manual/pics/LEGO_logo.png")
        ->setWideScreen();

$vjs[] = (new VideoJs("http://www.w3schools.com/html/mov_bbb.mp4"))
        ->addSource("http://www.w3schools.com/html/mov_bbb.ogg")
        ->setWideScreen();
$vjs[] = (new VideoJs())
        ->addSource("http://clips.vorwaerts-gmbh.de/VfE_html5.mp4")
        ->addSource("http://video-js.zencoder.com/oceans-clip.webm")
        ->addSource("http://video-js.zencoder.com/oceans-clip.ogv")
        ->setWideScreen();
       
$blockGrid = new BlockGrid($vjs, 1, 2, 3);
$blockGrid->getColumn(2)->setCssClass("show-for-large");
$blockGrid->printHtml();
echo "</div>";


