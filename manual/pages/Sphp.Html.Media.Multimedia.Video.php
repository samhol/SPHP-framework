<?php

namespace Sphp\Html\Media\Multimedia;

use Sphp\Html\Apps\Manual\Apis;
use Sphp\Html\Apps\Syntaxhighlighting\CodeExampleAccordionBuilder;

$audio = \Sphp\Manual\api()->classLinker(Audio::class);
$audioTag = Apis::w3schools()->tag('audio');
$video = \Sphp\Manual\api()->classLinker(Video::class);
$videoTag = Apis::w3schools()->tag('video');
$source = \Sphp\Manual\api()->classLinker(Source::class);
$vjs = \Sphp\Manual\api()->classLinker(VideoJs::class);
$dailyMotionPlayer = \Sphp\Manual\api()->classLinker(DailyMotionPlayer::class);
$youtubePlayer = \Sphp\Manual\api()->classLinker(YoutubePlayer::class);
$vimeoPlayer = \Sphp\Manual\api()->classLinker(VimeoPlayer::class);
\Sphp\Manual\parseDown(<<<MD
##HTML 5 <small>Audio and Video</small> 
		
The $audio and the $video components implement the corresponding HTML5
$audioTag and $videoTag tags. With 
them it is possible to view video and audio streams.

The $source component specifies media resources for $audio and $video media components.
With the $source components it is possible to specify alternative media files 
which the browser may choose from, based on its media type or codec support.

MD
);

(new CodeExampleAccordionBuilder("Sphp/Html/Media/Multimedia/Video.php", null, true))
        ->setExamplePaneTitle("HTML5 &lt;video&gt; example code")
        ->setOutputPaneTitle("HTML5 &lt;video&gt; example results")
        ->printHtml();
