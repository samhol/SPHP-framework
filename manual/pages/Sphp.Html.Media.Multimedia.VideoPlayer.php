<?php

namespace Sphp\Html\Media\Multimedia;

use Sphp\Manual;

$videoPlayer = Manual\api()->classLinker(VideoPlayer::class);
$abstractVideoPlayer = Manual\api()->classLinker(AbstractVideoPlayer::class);
$dailyMotionPlayer = Manual\api()->classLinker(DailyMotionPlayer::class);
$youtubePlayer = Manual\api()->classLinker(YoutubePlayer::class);
$vimeoPlayer = Manual\api()->classLinker(VimeoPlayer::class);

Manual\md(<<<MD
##Video hosting services <small>Dailymotion, Youtube, Vimeo ,... etc.</small>
        
The $videoPlayer interface has an abstract implementation $abstractVideoPlayer. 
This class is extended to support following subscribers.

 * The $youtubePlayer component embeds a YouTube video on a website.
 * The $dailyMotionPlayer component embeds a Dailymotion video on a website.
 * The $vimeoPlayer component embeds a Vimeo video on a website.

MD
);

Manual\example("Sphp/Html/Media/Multimedia/VideoPlayer.php")
        ->setExamplePaneTitle("Example code for Youtube, Vimeo and DailyMotion video")
        ->setOutputPaneTitle("Example results")
        ->printHtml();
