<?php

namespace Sphp\Html\Media\Multimedia;

$videoJS = new VideoJs();
$videoJS->addSource("http://techslides.com/demos/sample-videos/small.webm");
$videoJS->addSource("http://techslides.com/demos/sample-videos/small.ogv");
$videoJS->addSource("http://techslides.com/demos/sample-videos/small.mp4");
$videoJS->addSource("http://techslides.com/demos/sample-videos/small.3gp");
$videoJS->showControls()
        ->setPoster("manual/pics/LEGO_logo.png")
        ->setWidescreen("4-3")
        ->printHtml();
