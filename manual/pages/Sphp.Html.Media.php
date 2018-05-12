<?php

namespace Sphp\Html\Media;

use Sphp\Manual;

$ns = Manual\api()->namespaceBreadGrumbs(__NAMESPACE__);

Manual\md(<<<MD
#HTML media: <small>images, audio, video, and animations</small>
$ns

MD
);
Manual\printPage('Sphp.Html.Media.SizeableInterface-LazyLoaderInterface');
Manual\printPage('Sphp.Html.Media.Img');
Manual\printPage('Sphp.Html.Media.ImgMap');
Manual\printPage('Sphp.Html.Media.Iframe');
