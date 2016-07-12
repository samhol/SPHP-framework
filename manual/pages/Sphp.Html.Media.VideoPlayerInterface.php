<?php

namespace Sphp\Html\Media;

use Sphp\Html\Apps\Manual\Apis as Apis;
use Sphp\Html\Foundation\F6\Containers\Accordions\CodeExampleAccordion as CodeExampleAccordion;

$videoPlayerInterface = Apis::apigen()->classLinker(VideoPlayerInterface::class);
$abstractVideoPlayer = Apis::apigen()->classLinker(AbstractVideoPlayer::class);
$dailyMotionPlayer = Apis::apigen()->classLinker(DailyMotionPlayer::class);
$youtubePlayer = Apis::apigen()->classLinker(YoutubePlayer::class);
$vimeoPlayer = Apis::apigen()->classLinker(VimeoPlayer::class);
echo $parsedown->text(<<<MD
##The $videoPlayerInterface for various Internet video subscribers
        
The $videoPlayerInterface has  a build-in implementation $abstractVideoPlayer. 
This class is axtended and used for following subscribers.

 * The $youtubePlayer component embeds a YouTube video on a website.
 * The $dailyMotionPlayer component embeds a Dailymotion video on a website.
 * The $vimeoPlayer component embeds a Vimeo video on a website.

MD
);

(new CodeExampleAccordion(EXAMPLE_DIR . "Sphp/Html/Media/VideoPlayerInterface.php"))
        ->setExampleHeading("Example code for Youtube, Vimeo and DailyMotion video")
        ->setOutputPaneTitle("Example results")
        ->printHtml();
