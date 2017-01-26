<?php

namespace Sphp\Html\Media\Multimedia;

use Sphp\Html\Foundation\Sites\Containers\Accordions\CodeExampleAccordion;

$vjs = $api->classLinker(VideoJs::class);
echo $parsedown->text(<<<MD
##The $vjs component

Video.js is an open source library for working with video on the web, also known as an HTML video player.
The $vjs Implements video.js for PHP. 
MD
);

CodeExampleAccordion::visualize(EXAMPLE_DIR . "Sphp/Html/Media/AV/VideoJs.php");
