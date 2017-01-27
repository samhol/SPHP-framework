<?php

namespace Sphp\Html\Media\Multimedia;

use Sphp\Html\Foundation\Sites\Containers\Accordions\CodeExampleAccordion;

$audio = $api->classLinker(Audio::class);
$video = $api->classLinker(Video::class);
$source = $api->classLinker(Source::class);
$ns = $api->namespaceBreadGrumbs(__NAMESPACE__);
echo $parsedown->text(<<<MD
#HTML MULTIMEDIA: <small>sound, music, videos, movies, and animations</small>
$ns 
MD
);
$load("Sphp.Html.Media.Multimedia.Video.php");
echo $parsedown->text(<<<MD
**Currently, there are 3 supported audio formats for the $audio component:**
		
* MP3 audio/mpeg
* Ogg audio/ogg
* Wav audio/wav
		
MD
);
(new CodeExampleAccordion(EXAMPLE_DIR . "Sphp/Html/Media/Multimedia/Audio.php", false, true))
        ->setExampleHeading("HTML5 &lt;audio&gt; example code")
        ->setOutputPaneTitle("HTML5 &lt;audio&gt; example results")
        ->printHtml();

$load("Sphp.Html.Media.Multimedia.Embed.php");
