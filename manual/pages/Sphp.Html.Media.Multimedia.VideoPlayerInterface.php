<?php

namespace Sphp\Html\Media\Multimedia;

use Sphp\Html\Apps\Manual\Apis;
use Sphp\Html\Apps\Syntaxhighlighting\CodeExampleBuilder;

$videoPlayerInterface = Apis::sami()->classLinker(VideoPlayerInterface::class);
$abstractVideoPlayer = Apis::sami()->classLinker(AbstractVideoPlayer::class);
$dailyMotionPlayer = Apis::sami()->classLinker(DailyMotionPlayer::class);
$youtubePlayer = Apis::sami()->classLinker(YoutubePlayer::class);
$vimeoPlayer = Apis::sami()->classLinker(VimeoPlayer::class);
echo $parsedown->text(<<<MD
##Video hosting services <small>Dailymotion, Youtube, Vimeo ,... etc.</small>
        
The $videoPlayerInterface has  a build-in implementation $abstractVideoPlayer. 
This class is axtended and used for following subscribers.

 * The $youtubePlayer component embeds a YouTube video on a website.
 * The $dailyMotionPlayer component embeds a Dailymotion video on a website.
 * The $vimeoPlayer component embeds a Vimeo video on a website.

MD
);

(new CodeExampleBuilder("Sphp/Html/Media/Multimedia/VideoPlayerInterface.php"))
        ->setExamplePaneTitle("Example code for Youtube, Vimeo and DailyMotion video")
        ->setOutputPaneTitle("Example results")
        ->printHtml();
