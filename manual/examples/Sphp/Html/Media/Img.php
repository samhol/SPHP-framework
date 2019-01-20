<?php

namespace Sphp\Html\Media;

use Sphp\Images\ImagineImage;
use Sphp\Images\SimpleCache;

(new Img('http://data.samiholck.com/images/crossbones.png', 'Original Skull'))
        ->setLazy(true)
        ->printHtml();

$image = new ImagineImage("http://data.samiholck.com/images/crossbones.png");
$cache = new SimpleCache('manual/pics/cache');

$fitted = $cache->save($image->scaleToFit(100, 60));
(new Img($fitted, "Fitted Skull"))
        ->setLazy(true)
        ->printHtml();

$scaled = $cache->save($image->scale(1.5));
(new Img($scaled, 'Widen Skull'))
        ->setLazy(true)
        ->printHtml();

$widen = $cache->save($image->widen(50));
(new Img($widen, 'Widen Skull'))
        ->setLazy(true)
        ->printHtml();
