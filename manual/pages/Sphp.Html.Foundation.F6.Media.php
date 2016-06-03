<?php

namespace Sphp\Html\Foundation\F6\Media;

$media = $api->getNamespaceLink(__NAMESPACE__);
$flexVideo = $api->classLinker(FlexVideo::class);

$ns = $api->getNamespaceBreadGrumbs(__NAMESPACE__);
echo $parsedown->text(<<<MD
#Foundation 6 MEDIA COMPONENTS

$ns
        
The $media namespace contains components for handling different media types
using the tools provided by Foundation framework.
MD
);

$load("Sphp.Html.Foundation.F6.Media.FlexVideo.php");
$load("Sphp.Html.Foundation.F6.Media.Orbit.php");
