<?php

namespace Sphp\Html\Media;

(new Img("manual/pics/crossbones.png", "Original Skull"))
        ->setLazy(true)
        ->printHtml();
Img::scale("manual/pics/crossbones.png", 1.2)
        ->setAlt("1.5 x Skull")
        ->setAttribute("title", "1.5 x original Skull")
        ->setLazy(true)
        ->printHtml();
Img::scale("manual/pics/crossbones.png", 0.5)
        ->setAlt("0.5 x Skull")
        ->setLazy(true)
        ->printHtml();
Img::resize("manual/pics/crossbones.png", 40, 60)
        ->setAlt("50 x 25 Skull")
        ->setLazy(true)
        ->printHtml();
Img::scaleToFit("manual/pics/crossbones.png", 20, 30)
        ->setLazy(true)
        ->printHtml();
