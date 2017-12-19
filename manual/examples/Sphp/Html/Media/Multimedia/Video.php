<?php

namespace Sphp\Html\Media\Multimedia;

$video = new Video();
$video->addSource("http://techslides.com/demos/sample-videos/small.webm");
$video->addSource("http://techslides.com/demos/sample-videos/small.ogv");
$video->addSource("http://techslides.com/demos/sample-videos/small.mp4");
$video->addSource("http://techslides.com/demos/sample-videos/small.3gp");
$video->setPoster("manual/pics/LEGO_logo.png")
        ->setWidth(300)
        ->setHeight(300)
        ->setLazy(true)
        ->printHtml();
