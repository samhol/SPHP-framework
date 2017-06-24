<?php

namespace Sphp\Html\Media\Multimedia;

use Sphp\Html\Apps\Syntaxhighlighting\CodeExampleBuilder;

$audio = $api->classLinker(Audio::class);

(new CodeExampleBuilder("Sphp/Html/Media/Multimedia/Audio.php", false, true))
        ->setExamplePaneTitle("HTML5 &lt;audio&gt; example code")
        ->setOutputPaneTitle("HTML5 &lt;audio&gt; example results")
        ->printHtml();
