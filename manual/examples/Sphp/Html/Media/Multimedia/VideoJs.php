<?php

namespace Sphp\Html\Media\Multimedia;

(new VideoJs())
        ->addSource("http://techslides.com/demos/sample-videos/small.webm")
        ->addSource("http://techslides.com/demos/sample-videos/small.ogv")
        ->addSource("http://techslides.com/demos/sample-videos/small.mp4")
        ->addSource("http://techslides.com/demos/sample-videos/small.3gp")
        ->showControls()
        ->setPoster("manual/pics/LEGO_logo.png")
        ->setWidescreen("4-3")
        ->printHtml();
