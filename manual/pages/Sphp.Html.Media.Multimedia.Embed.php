<?php

namespace Sphp\Html\Media\Multimedia;

use Sphp\Manual;

$embed = Manual\api()->classLinker(Embed::class);
$embedTag = Manual\w3schools()->tag('embed');

Manual\md(<<<MD
##The $embed component

The $embed class models the HTML $embedTag tag. This component can be 
used for setting external external applications or interactive contents (plug-ins).
MD
);

Manual\example('Sphp/Html/Media/Multimedia/Embed.php', null, true)
        ->setExamplePaneTitle('HTML &lt;embed&gt; example code')
        ->setOutputPaneTitle('HTML &lt;embed&gt; example results')
        ->printHtml();
