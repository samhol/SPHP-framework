<?php

namespace Sphp\Html\Media;

use Sphp\Html\Foundation\Structure\Grid as Grid;

$grid = new Grid();
$width = 384;
$height = 216;

$grid[] = (new Img("http://sphp.samiholck.com/sphpManual/photos/spacewalk.jpg"))
        ->setWidth($width)
        ->setHeight($height)
        ->setLazy();
$grid[] = (new Iframe())
        ->setSrc("http://sphp.samiholck.com/loremIpsum.txt")
        ->setWidth($width)
        ->setHeight($height)
        ->setLazy();
$grid[] = (new YoutubePlayer("WwrpLgWyAjU"))
        ->setWidth($width)
        ->setHeight($height)
        ->setLazy();

$grid->printHtml();
