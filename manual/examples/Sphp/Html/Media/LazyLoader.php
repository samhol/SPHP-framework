<?php

namespace Sphp\Html\Media;

use Sphp\Html\Foundation\Structure\Grid as Grid;

$grid = new Grid();
$size = new Size(384, 216);
//$img = Img::scaleToFit("http://sphp.samiholck.com/sphpManual/photos/spacewalk.jpg", 100);
$grid[] = (new Img("http://sphp.samiholck.com/sphpManual/photos/spacewalk.jpg"))
        ->setSize($size)
        ->setLazy();
$grid[] = (new Iframe())
        ->setSrc("http://sphp.samiholck.com/loremIpsum.txt")
        ->setSize($size)
        ->setLazy();
$grid[] = (new YoutubePlayer("WwrpLgWyAjU"))
        ->setSize($size)
        ->setLazy();

$grid->printHtml();
