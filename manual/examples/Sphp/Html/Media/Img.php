<?php

namespace Sphp\Html\Media;

(new Img("http://playground.samiholck.com/manual/pics/footer_skull.png", "Skull"))
        ->setLazy(true)
        ->printHtml();
Img::scale("http://playground.samiholck.com/manual/pics/footer_skull.png", 0.3)
        ->setLazy(true)
        ->printHtml();
Img::scale("http://playground.samiholck.com/manual/pics/footer_skull.png", 0.8)
        ->setLazy(true)
        ->printHtml();
$size = new Size(30, 25);
Img::resize("http://playground.samiholck.com/manual/pics/footer_skull.png", $size)
        ->setLazy(true)
        ->printHtml();
Img::scaleToFit("http://playground.samiholck.com/manual/pics/footer_skull.png", $size)
        ->setLazy(true)
        ->printHtml();
?> 
