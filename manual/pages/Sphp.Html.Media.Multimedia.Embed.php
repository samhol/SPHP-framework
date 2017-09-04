<?php

namespace Sphp\Html\Media\Multimedia;

use Sphp\Html\Apps\Syntaxhighlighting\CodeExampleBuilder;
use Sphp\Html\Apps\Manual\Apis;

$embed = Apis::sami()->classLinker(Embed::class);
$embedTag = Apis::w3schools()->tag('embed');
\Sphp\Manual\parseDown(<<<MD
##The $embed component

The $embed class models the HTML $embedTag tag. This component can be 
used for setting external external applications or interactive contents (plug-ins).
MD
);

(new CodeExampleBuilder("Sphp/Html/Media/Multimedia/Embed.php", false, true))
        ->setExamplePaneTitle("HTML &lt;embed&gt; example code")
        ->setOutputPaneTitle("HTML &lt;embed&gt; example results")
        ->printHtml();
