<?php

namespace Sphp\Html\Media\Multimedia;

use Sphp\Html\Foundation\Sites\Containers\Accordions\CodeExampleAccordion;

$embed = $api->classLinker(Embed::class);
echo $parsedown->text(<<<MD
##The $embed component

The $embed class models the HTML {$w3schools->tag("embed")} tag. This component can be 
used for setting external external applications or interactive contents (plug-ins).
MD
);

(new CodeExampleAccordion(EXAMPLE_DIR . "Sphp/Html/Media/Multimedia/Embed.php", false, true))
        ->setExampleHeading("HTML &lt;embed&gt; example code")
        ->setOutputPaneTitle("HTML &lt;embed&gt; example results")
        ->printHtml();