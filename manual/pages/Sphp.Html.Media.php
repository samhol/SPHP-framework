<?php

namespace Sphp\Html\Media;

use Sphp\Manual;

$ns = Manual\api()->namespaceBreadGrumbs(__NAMESPACE__);

Manual\md(<<<MD
#HTML media: <small>images, sound, music, videos, movies, and animations</small>
$ns

MD
);
Manual\loadPage('Sphp.Html.Media.SizeableInterface-LazyLoaderInterface');
Manual\loadPage('Sphp.Html.Media.Img');
Manual\loadPage('Sphp.Html.Media.ImgMap');
Manual\loadPage('Sphp.Html.Media.Iframe');
