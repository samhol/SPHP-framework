<?php

namespace Sphp\Html\Media;

$ns = $api->namespaceBreadGrumbs(__NAMESPACE__);

echo $parsedown->text(<<<MD
#HTML MEDIA: <small>images, sound, music, videos, movies, and animations</small>
$ns

MD
);
$load('Sphp.Html.Media.SizeableInterface-LazyLoaderInterface');
$load('Sphp.Html.Media.Img');
$load('Sphp.Html.Media.ImgMap');
$load('Sphp.Html.Media.Iframe');
//$load("Sphp.Html.Media.AV.VideoPlayerInterface.php");
//$load("Sphp.Html.Media.AV.VideoJs.php");
//$load("Sphp.Html.Media.AV.Video.php");
