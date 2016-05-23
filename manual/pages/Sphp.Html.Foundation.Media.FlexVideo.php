<?php

namespace Sphp\Html\Foundation\Media;

use Sphp\Html\Apps\ApiTools\PHPExampleViewer as CodeExampleViewer;

$flexVideo = $api->getClassLink(FlexVideo::class);

echo $parsedown->text(<<<MD
		
###The $flexVideo component for embedded video
		
$flexVideo lets browsers automatically scale video objects in webpages. 
If a video is embedded from YouTube or Vimeo. It
is possible to use $flexVideo to create an intrinsic ratio that will properly 
scale the video on any device.
MD
);

CodeExampleViewer::visualize(EXAMPLE_DIR . 'Sphp/Html/Foundation/Media/FlexVideo.php');