<?php

namespace Sphp\Images;

use Sphp\Html\Media\Img;
//echo 'fff';
$scaler = new ImagineImage('manual/pics/example.jpg');
$scaler->widen(50);
//echo $scaler->save('manual/pics/cache/p.jpg')->httpCachePath();
echo new Img('manual/pics/example.jpg', 'Example');
echo new Img('manual/pics/cache/p.jpg', 'Example');
echo new Img('manual/pics/example.jpg.php?scale=.5', 'Example image');

