<?php

namespace Sphp\Html\Media\AV;

use Sphp\Html\Foundation\F6\Containers\Accordions\CodeExampleAccordion;

$vjs = $api->classLinker(VideoJs::class);
echo $parsedown->text(<<<MD
##The $vjs component

Video.js is an open source library for working with video on the web, also known as an HTML video player.
The $vjs class implements video.js for PHP. 
MD
);

CodeExampleAccordion::visualize(EXAMPLE_DIR . "Sphp/Html/Media/AV/VideoJs.php");
