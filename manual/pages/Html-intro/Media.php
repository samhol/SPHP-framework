<?php

namespace Sphp\Html\Media\Multimedia;

use Sphp\Html\Apps\Manual\Apis;
use Sphp\Html\Foundation\Sites\Grids\BlockGrid as BlockGrid;

$ns = \Sphp\Manual\api()->namespaceBreadGrumbs(__NAMESPACE__);
$videoJs = \Sphp\Manual\api()->classLinker(VideoJs::class);
echo <<<MD
##`HTML` Media components

$ns
        
This namespace contains components for handling different media types
using the tools provided by Foundation framework.

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
$blockGrid->getColumn(2)->addCssClass("show-for-large");
$blockGrid->printHtml();
echo "</div>";


