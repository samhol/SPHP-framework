<?php

namespace Sphp\Html\Foundation\Content;

$accordion1 = new Accordion("First Accordion");
$accordion1->getContent()
        ->ajaxReplace("http://sphp.samiholck.com/sphpManual/examples/loremIpsum.txt");
$accordions = (new Accordions())
        ->append($accordion1)
        ->append(new Accordion("Second Accordion", "Nothing intresting here"));
$accordions->printHtml();
?>