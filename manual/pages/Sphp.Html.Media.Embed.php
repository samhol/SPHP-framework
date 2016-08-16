<?php

namespace Sphp\Html\Media;

use Sphp\Html\Foundation\F6\Containers\Accordions\CodeExampleAccordion as CodeExampleAccordion;

$embed = $api->classLinker(Embed::class);
echo $parsedown->text(<<<MD
##The $embed component

The $embed class models the HTML {$w3schools->tag("embed")} tag. This component can be 
used for setting external external applications or interactive contents (plug-ins).
MD
);

(new CodeExampleAccordion(EXAMPLE_DIR . "Sphp/Html/Media/Embed.php", false, true))
        ->setExampleHeading("HTML &lt;embed&gt; example code")
        ->setOutputPaneTitle("HTML &lt;embed&gt; example results")
        ->printHtml();
