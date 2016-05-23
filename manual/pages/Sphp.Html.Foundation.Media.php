<?php

namespace Sphp\Html\Foundation\Media;

$media = $api->getNamespaceLink(__NAMESPACE__);
$flexVideo = $api->classLinker(FlexVideo::class);

$ns = $api->getNamespaceBreadGrumbs(__NAMESPACE__);
echo $parsedown->text(<<<MD
##HTML MEDIA COMPONENTS

$ns
        
The $media namespace contains components for handling different media types
using the tools provided by Foundation framework.
MD
);

$load("Sphp.Html.Foundation.Media.FlexVideo.php");
$load("Sphp.Html.Foundation.Media.Clearing.php");
//$load("Sphp.Html.Foundation.Media.Orbit.php");
