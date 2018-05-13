<?php

namespace Sphp\Html\Media;

use Sphp\Manual;

$ns = Manual\api()->namespaceBreadGrumbs(__NAMESPACE__);

Manual\md(<<<MD
#HTML <small>Multimedia</small>
$ns
Multimedia on the web consists of sound, music, videos, movies, and animations. 
SPHPLayground contains numerous multimedia components for different media types.
MD
);
Manual\printPage('Sphp.Html.Media.SizeableInterface-LazyLoaderInterface');
Manual\printPage('Sphp.Html.Media.Img');
Manual\printPage('Sphp.Html.Media.ImgMap');
Manual\printPage('Sphp.Html.Media.Iframe');
