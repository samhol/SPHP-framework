<?php

namespace Sphp\Images;

use Sphp\Html\Media\Img;

$image = new ImagineImage('manual/pics/example.jpg');

$cache = new SimpleCache('manual/pics/cache');
$cachedFile = $cache->save($image->widen(50));
echo new Img('manual/pics/example.jpg', 'Example');
echo new Img($cachedFile, 'Example');
echo new Img('manual/pics/example.jpg.php?scale=.5', 'Example image');
