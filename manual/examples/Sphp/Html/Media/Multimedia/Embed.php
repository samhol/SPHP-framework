<?php

namespace Sphp\Html\Media\Multimedia;

$embed = new Embed("http://www.w3schools.com/tags/helloworld.swf");
$embed->inlineStyles()->setProperty("border", "solid 1px #555");
$embed->printHtml();
