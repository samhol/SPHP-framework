<?php

namespace Sphp\Html\Media\Multimedia;

use Sphp\Html\Apps\Syntaxhighlighting\CodeExampleAccordionBuilder;

$audio = \Sphp\Manual\api()->classLinker(Audio::class);

(new CodeExampleAccordionBuilder("Sphp/Html/Media/Multimedia/Audio.php", null, true))
        ->setExamplePaneTitle("HTML5 &lt;audio&gt; example code")
        ->setOutputPaneTitle("HTML5 &lt;audio&gt; example results")
        ->printHtml();
