<?php

namespace Sphp\Html\Media;

$imgTag = $api->getClassLink(Img::class);
$iframe = $api->getClassLink(Iframe::class);
$ns = $api->getNamespaceBreadGrumbs(__NAMESPACE__);

echo $parsedown->text(<<<MD
#HTML MEDIA CONTAINERS (IMAGES, AUDIO, VIDEO...) 
$ns

MD
);
$load("Sphp.Html.Media.SizeableInterface-LazyLoaderInterface.php");
$load("Sphp.Html.Media.Img.php");
$load("Sphp.Html.Media.ImgMap.php");
$load("Sphp.Html.Media.Iframe.php");
$load("Sphp.Html.Media.VideoPlayerInterface.php");
$load("Sphp.Html.Media.Video.php");
$load("Sphp.Html.Media.Embed.php");
