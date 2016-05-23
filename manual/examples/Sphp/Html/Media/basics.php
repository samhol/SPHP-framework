<?php

namespace Sphp\Html\Media;

use Sphp\Html\Foundation\Structure\Row as Row;

$videoTag1 = (new VideoTag())
        ->setSource("http://techslides.com/demos/sample-videos/small.mp4", "video/mp4")
        ->showControls(true)
        ->setLoop(true)
        ->setDimensions(280, 160);


$videoTag2 = clone $videoTag1;

(new Row([$videoTag1, $videoTag2]))->printHtml();
?>