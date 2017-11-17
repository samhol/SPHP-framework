<?php

namespace Sphp\Html\Media\Multimedia;

use Sphp\Manual;

$ns = Manual\api()->namespaceBreadGrumbs(__NAMESPACE__);
Manual\parseDown(<<<MD
#HTML MULTIMEDIA: <small>sound, music, videos, movies, and animations</small>
$ns 
MD
);

Manual\loadPage('Sphp.Html.Media.Multimedia.Video');
Manual\loadPage('Sphp.Html.Media.Multimedia.Audio');
Manual\loadPage('Sphp.Html.Media.Multimedia.VideoJs');
Manual\loadPage('Sphp.Html.Media.Multimedia.VideoPlayerInterface');
Manual\loadPage('Sphp.Html.Media.Multimedia.Embed');
