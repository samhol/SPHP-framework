<?php

namespace Sphp\Html\Media\Multimedia;

$video = $api->classLinker(Video::class);
$source = $api->classLinker(Source::class);
$ns = $api->namespaceBreadGrumbs(__NAMESPACE__);
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
