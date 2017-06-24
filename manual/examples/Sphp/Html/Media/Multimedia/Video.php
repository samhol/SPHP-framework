<?php

namespace Sphp\Html\Media\Multimedia;

(new Video())
        ->addSource("http://techslides.com/demos/sample-videos/small.webm")
        ->addSource("http://techslides.com/demos/sample-videos/small.ogv")
        ->addSource("http://techslides.com/demos/sample-videos/small.mp4")
        ->addSource("http://techslides.com/demos/sample-videos/small.3gp")
        ->setPoster("manual/pics/LEGO_logo.png")
        ->setWidth(300)
        ->setHeight(300)
        ->setLazy(true)
        ->printHtml();
