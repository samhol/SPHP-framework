<?php

namespace Sphp\Html\Media;

$img = (new Img("http://playground.samiholck.com/manual/pics/crossbones.png", "Skull"))
        ->useMap("crossbones")
        ->setLazy(true)
        ->printHtml();
$map = (new ImageMap\Map("crossbones"))
        ->append((new ImageMap\Circle(165, 140, 26))
                ->setHref("https://en.wikipedia.org/wiki/Skull_and_crossbones")
                ->setTarget("_blank"))
        ->printHtml();
?> 
