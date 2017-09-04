<?php

namespace Sphp\Html\Media\Multimedia;

use Sphp\Html\Apps\Syntaxhighlighting\CodeExampleBuilder;
use Sphp\Html\Apps\Manual\Apis;

$audio = Apis::sami()->classLinker(Audio::class);

(new CodeExampleBuilder("Sphp/Html/Media/Multimedia/Audio.php", false, true))
        ->setExamplePaneTitle("HTML5 &lt;audio&gt; example code")
        ->setOutputPaneTitle("HTML5 &lt;audio&gt; example results")
        ->printHtml();
