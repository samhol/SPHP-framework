<?php

namespace Sphp\Html\Media;

$img = (new Img("http://playground.samiholck.com/manual/pics/shapes.png", "Basic shapes"))
        ->useMap("shapes")
        ->setLazy(true)
        ->printHtml();
$map = (new ImageMap\Map("shapes"))
        ->append((new ImageMap\Circle(361, 132, 96))
                ->setTitle("Circle in Wikipedia")
                ->setHref("https://en.wikipedia.org/wiki/Circle")
                ->setTarget("_blank"))
        ->append((new ImageMap\Rectangle(21, 28, 222, 228))
                ->setTitle("Rectangle in Wikipedia")
                ->setHref("https://en.wikipedia.org/wiki/Rectangle")
                ->setTarget("_blank"))
        ->printHtml();
