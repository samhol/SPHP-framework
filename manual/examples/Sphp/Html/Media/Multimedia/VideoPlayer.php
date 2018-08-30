<?php

namespace Sphp\Html\Media\Multimedia;

(new YoutubePlayer("VjDnB9xWodM"))
        ->loop(false)
        ->setLazy()
        ->setEndTime(5)
        ->setWidth(150)
        ->setHeight(113)
        ->printHtml();
