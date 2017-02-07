<?php

namespace Sphp\Html\Media;
use Sphp\Core\Path;
(new Img("http://playground.samiholck.com/manual/pics/crossbones.png", "Original Skull"))
        ->setLazy(true)
        ->printHtml();
$p = Path::get()->local("manual/pics/crossbones.png");
Img::scale($p, 1.2)
        ->setAlt("1.5 x Skull")
        ->setAttr("title", "1.5 x original Skull")
        ->setLazy(true)
        ->printHtml();
Img::scale($p, 0.5)
        ->setAlt("0.5 x Skull")
        ->setLazy(true)
        ->printHtml();
$size = new Size(100, 50);
Img::resize($p, $size)
        ->setAlt("50 x 25 Skull")
        ->setLazy(true)
        ->printHtml();
Img::scaleToFit($p, $size)
        ->setLazy(true)
        ->printHtml();
?> 
