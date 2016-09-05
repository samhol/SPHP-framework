<?php

namespace Sphp\Html\Media\AV;

use Sphp\Html\Media\Size as Size;

$srcs[] = "http://techslides.com/demos/sample-videos/small.webm";
$srcs[] = "http://techslides.com/demos/sample-videos/small.ogv";
$srcs[] = "http://techslides.com/demos/sample-videos/small.mp4";
$srcs[] = "http://techslides.com/demos/sample-videos/small.3gp";

$size = new Size(384, 216);

$video = (new Video($srcs))
        ->setPoster("manual/pics/LEGO_logo.png")
        ->setSize($size)
        ->setLazy()
        ->printHtml();

$video1 = (new Video("http://www.w3schools.com/html/mov_bbb.mp4"))
        ->addSource("http://www.w3schools.com/html/mov_bbb.ogg")
        ->loop(true)
        ->setSize($size)
        ->setLazy()
        ->printHtml();
?>