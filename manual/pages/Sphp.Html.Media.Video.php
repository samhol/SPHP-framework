<?php

namespace Sphp\Html\Media;

use Sphp\Html\Apps\ApiTools\PHPExampleViewer as CodeExampleViewer;

$audio = $api->getClassLink(Audio::class);
$video = $api->getClassLink(Video::class);
$source = $api->getClassLink(Source::class);
echo $parsedown->text(<<<MD
##The $audio and the $video components
		
The $audio and the $video components implement the corresponding HTML5
{$w3schools->getTagLink("audio")} and {$w3schools->getTagLink("video")} tags. With 
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

use Sphp\Html\Foundation\F6\Containers\Accordions\CodeExampleAccordion as CodeExampleAccordion;

(new CodeExampleAccordion(EXAMPLE_DIR . "Sphp/Html/Media/Video.php", false, true))
		->setExampleHeading("HTML5 &lt;video&gt; example code")
		->setOutputPaneTitle("HTML5 &lt;video&gt; example results")
		->printHtml();

echo $parsedown->text(<<<MD
**Currently, there are 3 supported audio formats for the $audio component:**
		
* MP3 audio/mpeg
* Ogg audio/ogg
* Wav audio/wav
		
MD
);
(new CodeExampleAccordion(EXAMPLE_DIR . "Sphp/Html/Media/Audio.php", false, true))
		->setExampleHeading("HTML5 &lt;audio&gt; example code")
		->setOutputPaneTitle("HTML5 &lt;audio&gt; example results")
		->printHtml();
