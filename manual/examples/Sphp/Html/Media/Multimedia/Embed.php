<?php

namespace Sphp\Html\Media\Multimedia;

(new Embed())
        ->setSrc("http://www.w3schools.com/tags/helloworld.swf")
        ->setStyle("border", "solid 1px #555")
        ->printHtml();
?>