<?php

namespace Sphp\Html\Media\Multimedia;

use Sphp\Html\Apps\Syntaxhighlighting\CodeExampleAccordionBuilder;
use Sphp\Html\Apps\Manual\Apis;

$vjs = \Sphp\Manual\api()->classLinker(VideoJs::class);
\Sphp\Manual\parseDown(<<<MD
##The $vjs component

Video.js is an open source library for working with video on the web, also known as an HTML video player.
The $vjs Implements video.js for PHP. 
MD
);

CodeExampleAccordionBuilder::visualize("Sphp/Html/Media/Multimedia/VideoJs.php");
