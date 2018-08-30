<?php

namespace Sphp\Html\Media\Multimedia;

use Sphp\Manual;

$embed = Manual\api()->classLinker(Embed::class);
$embedTag = Manual\w3schools()->embed;

$object = Manual\api()->classLinker(Object::class);
$objectTag = Manual\w3schools()->object;

Manual\md(<<<MD
##The $embed component

The $embed class models the HTML $embedTag tag. This component can be 
used for setting external external applications or interactive contents (plug-ins).

##The $object component

The $object class models the HTML $objectTag tag. This component can be 
used for setting external external applications or interactive contents (plug-ins).
        
The $objectTag tag defines an embedded object within an HTML document. Use this element to embed multimedia (like audio, video, Java applets, ActiveX, PDF, and Flash) in your web pages.

You can also use the it to embed another webpage into your HTML document.

You can use the param tag to pass parameters to plugins that have been embedded with the object
MD
);

Manual\example('Sphp/Html/Media/Multimedia/Embed-Object.php', 'html5', true)
        ->setExamplePaneTitle('HTML &lt;embed&gt; and &lt;object&gt; example code')
        ->setOutputPaneTitle('HTML example results')
        ->printHtml();
