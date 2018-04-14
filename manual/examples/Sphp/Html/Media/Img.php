<?php

namespace Sphp\Html\Media;

(new Img("http://data.samiholck.com/images/crossbones.png", "Original Skull"))
        ->setLazy(true)
        ->printHtml();
Img::scale("http://data.samiholck.com/images/crossbones.png", 1.2)
        ->setAlt("1.5 x Skull")
        ->setAttribute("title", "1.5 x original Skull")
        ->setLazy(true)
        ->printHtml();
Img::scale("http://data.samiholck.com/images/crossbones.png", 0.5)
        ->setAlt("0.5 x Skull")
        ->setLazy(true)
        ->printHtml();
Img::resize("http://data.samiholck.com/images/crossbones.png", 40, 60)
        ->setAlt("50 x 25 Skull")
        ->setLazy(true)
        ->printHtml();
Img::scaleToFit("http://data.samiholck.com/images/crossbones.png", 20, 30)
        ->setLazy(true)
        ->printHtml();
