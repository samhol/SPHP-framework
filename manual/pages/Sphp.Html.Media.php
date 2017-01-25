<?php

namespace Sphp\Html\Media;

$ns = $api->namespaceBreadGrumbs(__NAMESPACE__);

echo $parsedown->text(<<<MD
#HTML MEDIA: <small>images, sound, music, videos, movies, and animations</small>
$ns

MD
);
$load("Sphp.Html.Media.SizeableInterface-LazyLoaderInterface.php");
$load("Sphp.Html.Media.Img.php");
$load("Sphp.Html.Media.ImgMap.php");
$load("Sphp.Html.Media.Iframe.php");
//$load("Sphp.Html.Media.AV.VideoPlayerInterface.php");
//$load("Sphp.Html.Media.AV.VideoJs.php");
//$load("Sphp.Html.Media.AV.Video.php");
$load("Sphp.Html.Media.Embed.php");
