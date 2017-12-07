<?php

namespace Sphp\Html\Media\Multimedia;

use Sphp\Html\Apps\Manual\Apis;
use Sphp\Html\Apps\Syntaxhighlighting\CodeExampleAccordionBuilder;

$videoPlayerInterface = \Sphp\Manual\api()->classLinker(VideoPlayerInterface::class);
$abstractVideoPlayer = \Sphp\Manual\api()->classLinker(AbstractVideoPlayer::class);
$dailyMotionPlayer = \Sphp\Manual\api()->classLinker(DailyMotionPlayer::class);
$youtubePlayer = \Sphp\Manual\api()->classLinker(YoutubePlayer::class);
$vimeoPlayer = \Sphp\Manual\api()->classLinker(VimeoPlayer::class);
\Sphp\Manual\md(<<<MD
##Video hosting services <small>Dailymotion, Youtube, Vimeo ,... etc.</small>
        
The $videoPlayerInterface has  a build-in implementation $abstractVideoPlayer. 
This class is axtended and used for following subscribers.

 * The $youtubePlayer component embeds a YouTube video on a website.
 * The $dailyMotionPlayer component embeds a Dailymotion video on a website.
 * The $vimeoPlayer component embeds a Vimeo video on a website.

MD
);

(new CodeExampleAccordionBuilder("Sphp/Html/Media/Multimedia/VideoPlayerInterface.php"))
        ->setExamplePaneTitle("Example code for Youtube, Vimeo and DailyMotion video")
        ->setOutputPaneTitle("Example results")
        ->printHtml();
