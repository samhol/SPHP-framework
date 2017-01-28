<?php

namespace Sphp\Html\Media\Multimedia;

use Sphp\Html\Apps\Manual\Apis;
use Sphp\Html\Foundation\Sites\Containers\Accordions\CodeExampleAccordion;

$audio = $api->classLinker(Audio::class);
$video = $api->classLinker(Video::class);
$source = $api->classLinker(Source::class);
$vjs = $api->classLinker(VideoJs::class);
$dailyMotionPlayer = Apis::apigen()->classLinker(DailyMotionPlayer::class);
$youtubePlayer = Apis::apigen()->classLinker(YoutubePlayer::class);
$vimeoPlayer = Apis::apigen()->classLinker(VimeoPlayer::class);
echo $parsedown->text(<<<MD
##Video: <small>HTML5 video, Dailymotion, Youtube, Vimeo and other embeds</small>
		
The $audio and the $video components implement the corresponding HTML5
{$w3schools->tag("audio")} and {$w3schools->tag("video")} tags. With 
them it is possible to view video and audio streams.

The $source component specifies media resources for $audio and $video media components.
With the $source components it is possible to specify alternative media files 
which the browser may choose from, based on its media type or codec support.

**Currently, there are 3 supported video formats for the $video component:**
		
* MP4 = MPEG 4 files with H264 video codec and AAC audio codec
* WebM = WebM files with VP8 video codec and Vorbis audio codec
* Ogg = Ogg files with Theora video codec and Vorbis audio codec

MD
);


(new CodeExampleAccordion(EXAMPLE_DIR . "Sphp/Html/Media/Multimedia/Video.php", false, true))
        ->setExampleHeading("HTML5 &lt;video&gt; example code")
        ->setOutputPaneTitle("HTML5 &lt;video&gt; example results")
        ->printHtml();


$load("Sphp.Html.Media.Multimedia.VideoJs.php");
$load("Sphp.Html.Media.Multimedia.VideoPlayerInterface.php");
