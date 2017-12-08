<?php

namespace Sphp\Html\Media\Multimedia;

use Sphp\Manual;

$audio = Manual\api()->classLinker(Audio::class);

Manual\example("Sphp/Html/Media/Multimedia/Audio.php", null, true)
        ->setExamplePaneTitle("HTML5 &lt;audio&gt; example code")
        ->setOutputPaneTitle("HTML5 &lt;audio&gt; example results")
        ->printHtml();
