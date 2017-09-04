<?php

namespace Sphp\Html\Media\Multimedia;

use Sphp\Html\Apps\Manual\Apis;

$video = Apis::sami()->classLinker(Video::class);
$source = Apis::sami()->classLinker(Source::class);
$ns = Apis::sami()->namespaceBreadGrumbs(__NAMESPACE__);
\Sphp\Manual\parseDown(<<<MD
#HTML MULTIMEDIA: <small>sound, music, videos, movies, and animations</small>
$ns 
MD
);

\Sphp\Manual\loadPage('Sphp.Html.Media.Multimedia.Video');
\Sphp\Manual\loadPage('Sphp.Html.Media.Multimedia.Audio');
\Sphp\Manual\loadPage('Sphp.Html.Media.Multimedia.VideoJs');
\Sphp\Manual\loadPage('Sphp.Html.Media.Multimedia.VideoPlayerInterface');
\Sphp\Manual\loadPage('Sphp.Html.Media.Multimedia.Embed');
