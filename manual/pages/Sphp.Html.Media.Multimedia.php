<?php

namespace Sphp\Html\Media\Multimedia;

$video = $api->classLinker(Video::class);
$source = $api->classLinker(Source::class);
$ns = $api->namespaceBreadGrumbs(__NAMESPACE__);
echo $parsedown->text(<<<MD
#HTML MULTIMEDIA: <small>sound, music, videos, movies, and animations</small>
$ns 
MD
);

$load('Sphp.Html.Media.Multimedia.Video');
$load('Sphp.Html.Media.Multimedia.Audio');
$load('Sphp.Html.Media.Multimedia.VideoJs');
$load('Sphp.Html.Media.Multimedia.VideoPlayerInterface');
$load('Sphp.Html.Media.Multimedia.Embed');
