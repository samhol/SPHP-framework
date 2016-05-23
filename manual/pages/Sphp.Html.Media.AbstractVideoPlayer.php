<?php

namespace Sphp\Html\Media;

$abstractVideoPlayer = $api->getClassLink(AbstractVideoPlayer::class);
$youtubePlayer = $api->getClassLink(YoutubePlayer::class);
$vimeoPlayer = $api->getClassLink(VimeoPlayer::class);
echo $parsedown->text(<<<MD
##The $abstractVideoPlayer class for various Internet video subscribers

###The $youtubePlayer class for Youtube videos	

The $youtubePlayer component embeds a YouTube video on a website.
		
$youtubePlayer Parameters:
* **autohide**
  * `0`: The player controls are always visible.
  * `1`: The player controls hides automatically when the video plays.
  * `2` (default): If the player has 16:9 or 4:3 ratio, same as 1, otherwise same as 0.
* **autoplay:**
  * `0` (default): The video will not play automatically when the player loads.
  * `1`: The video will play automatically when the player loads.
* **controls:**
  * `0`: Player controls does not display. The video loads immediately.
  * `1` (default): Player controls display. The video loads immediately.
  * `2`: Player controls display, but the video does not load before the user initiates playback. 
* **loop:**
  * `0` (default): The video will play only once.
  * `1`: The video will loop (forever).
MD
);

use Sphp\Html\Foundation\F6\Containers\Accordions\CodeExampleAccordion as CodeExampleAccordion;

(new CodeExampleAccordion(EXAMPLE_DIR . "Sphp/Html/Media/AbstractVideoPlayer.php", FALSE))
        ->setExampleHeading("Youtube video example code")
        ->setOutputPaneTitle("Example results")
        ->printHtml();
echo $parsedown->text(<<<MD
###The $vimeoPlayer class for Vimeo videos	
MD
);
