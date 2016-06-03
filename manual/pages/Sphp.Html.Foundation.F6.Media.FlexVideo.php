<?php

namespace Sphp\Html\Foundation\F6\Media;

use Sphp\Html\Foundation\F6\Containers\Accordions\CodeExampleAccordion as CodeExampleAccordion;

$flexVideo = $api->getClassLink(FlexVideo::class);

echo $parsedown->text(<<<MD
		
###The $flexVideo component for embedded video
		
$flexVideo lets browsers automatically scale video objects in webpages. 
If a video is embedded from YouTube or Vimeo. It
is possible to use $flexVideo to create an intrinsic ratio that will properly 
scale the video on any device.
MD
);

CodeExampleAccordion::visualize(EXAMPLE_DIR . 'Sphp/Html/Foundation/F6/Media/FlexVideo.php');