<?php

namespace Sphp\Html\Foundation\F6\Containers\Accordions;

$pane = new Pane("First Accordion");
$pane->ajaxAppend("manual/snippets/loremipsum.html #par_3");
$accordion = (new Accordion())
        ->append($pane)
        ->append(new Pane("Second Accordion", "Nothing intresting here"))
        ->allowMultiExpand()
        ->allowAllClosed()
        ->printHtml();
?>
