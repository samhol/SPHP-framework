<?php

namespace Sphp\Html\Media\Multimedia;

use Sphp\Manual;

$audio = Manual\api()->classLinker(Audio::class);
$audioTag = Manual\w3schools()->tag('audio');
$video = Manual\api()->classLinker(Video::class);
$videoTag = Manual\w3schools()->tag('video');
$source = Manual\api()->classLinker(Source::class);
$vjs = Manual\api()->classLinker(VideoJs::class);
$dailyMotionPlayer = Manual\api()->classLinker(DailyMotionPlayer::class);
$youtubePlayer = Manual\api()->classLinker(YoutubePlayer::class);
$vimeoPlayer = Manual\api()->classLinker(VimeoPlayer::class);

Manual\md(<<<MD
##HTML 5 <small>Audio and Video</small> 
		
The $audio and the $video components implement the corresponding HTML5
$audioTag and $videoTag tags. With 
them it is possible to view video and audio streams.

The $source component specifies media resources for $audio and $video media components.
With the $source components it is possible to specify alternative media files 
which the browser may choose from, based on its media type or codec support.

MD
);

Manual\example('Sphp/Html/Media/Multimedia/Video.php', 'html5', true)
        ->setExamplePaneTitle('HTML5 &lt;video&gt; example code')
        ->setOutputPaneTitle('HTML5 &lt;video&gt; example results')
        ->printHtml();
