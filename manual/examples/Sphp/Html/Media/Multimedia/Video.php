<?php

namespace Sphp\Html\Media\Multimedia;

$srcs[] = "http://techslides.com/demos/sample-videos/small.webm";
$srcs[] = "http://techslides.com/demos/sample-videos/small.ogv";
$srcs[] = "http://techslides.com/demos/sample-videos/small.mp4";
$srcs[] = "http://techslides.com/demos/sample-videos/small.3gp";


$width = 150;
$height = 113;

$video = (new Video($srcs))
        ->setPoster("manual/pics/LEGO_logo.png")
        ->setWidth($width)
        ->setHeight($height)
        ->setLazy()
        ->printHtml();

$video1 = (new Video("http://www.w3schools.com/html/mov_bbb.mp4"))
        ->addSource("http://www.w3schools.com/html/mov_bbb.ogg")
        ->loop(true)
        ->setWidth($width)
        ->setHeight($height)
        ->setLazy()
        ->printHtml();
