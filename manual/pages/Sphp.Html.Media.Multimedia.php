<?php

namespace Sphp\Html\Media\Multimedia;

use Sphp\Manual;

$ns = Manual\api()->namespaceBreadGrumbs(__NAMESPACE__);
Manual\md(<<<MD
#HTML MULTIMEDIA: <small>sound, music, videos, movies, and animations</small>
$ns 
MD
);

Manual\printPage('Sphp.Html.Media.Multimedia.Video');
Manual\printPage('Sphp.Html.Media.Multimedia.Audio');
Manual\printPage('Sphp.Html.Media.Multimedia.VideoJs');
Manual\printPage('Sphp.Html.Media.Multimedia.VideoPlayerInterface');
Manual\printPage('Sphp.Html.Media.Multimedia.Embed');
