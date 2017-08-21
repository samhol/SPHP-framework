<?php

namespace Sphp\Html\Media\Multimedia;

use Sphp\Html\Apps\Manual\Apis;
use Sphp\Html\Apps\Syntaxhighlighting\CodeExampleBuilder;

$audio = $api->classLinker(Audio::class);
$video = $api->classLinker(Video::class);
$source = $api->classLinker(Source::class);
$vjs = $api->classLinker(VideoJs::class);
$dailyMotionPlayer = Apis::sami()->classLinker(DailyMotionPlayer::class);
$youtubePlayer = Apis::sami()->classLinker(YoutubePlayer::class);
$vimeoPlayer = Apis::sami()->classLinker(VimeoPlayer::class);
\Sphp\Manual\parseDown(<<<MD
##HTML 5 <small>Audio and Video</small> 
		
The $audio and the $video components implement the corresponding HTML5
{$w3schools->tag("audio")} and {$w3schools->tag("video")} tags. With 
them it is possible to view video and audio streams.

The $source component specifies media resources for $audio and $video media components.
With the $source components it is possible to specify alternative media files 
which the browser may choose from, based on its media type or codec support.

MD
);

(new CodeExampleBuilder("Sphp/Html/Media/Multimedia/Video.php", false, true))
        ->setExamplePaneTitle("HTML5 &lt;video&gt; example code")
        ->setOutputPaneTitle("HTML5 &lt;video&gt; example results")
        ->printHtml();
