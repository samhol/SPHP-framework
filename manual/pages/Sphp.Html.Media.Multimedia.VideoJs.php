<?php

namespace Sphp\Html\Media\Multimedia;

use Sphp\Manual;

$vjs = Manual\api()->classLinker(VideoJs::class);

Manual\md(<<<MD
##The $vjs component

Video.js is an open source library for working with video on the web, also known as an HTML video player.
The $vjs Implements video.js for PHP. 
MD
);

Manual\visualize("Sphp/Html/Media/Multimedia/VideoJs.php");
